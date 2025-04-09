<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Contact;

class ContactForm extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $status; // 1 = positive, 0 = negative
    public $success = null;

    // Updated rules: phone is now optional, but if provided must match regex
    protected function rules()
    {
        return [
            'name'    => 'required|string|max:255',            // Required name, max 255 characters
            'email'   => 'required|email',                     // Required valid email
            'phone'   => ['nullable', 'regex:/^[0-9]{10}$/'],  // Optional, but if present must be 10 digits
            'message' => 'required|string|min:5',              // Required message, min 5 characters
            'status'  => 'required|boolean',                   // Required status: 1 or 0
        ];
    }

    // Optional custom error message for phone
    protected $messages = [
        'phone.regex' => 'The phone number must contain exactly 10 digits.',
    ];

    public function submit()
    {
        try {
            $this->validate(); // Validate with updated rules

            // Store the contact
            Contact::create([
                'name'    => $this->name,
                'email'   => $this->email,
                'phone'   => $this->phone,
                'message' => $this->message,
                'status'  => $this->status,
            ]);

            // Reset form fields and show success message
            $this->reset(['name', 'email', 'phone', 'message', 'status']);
            $this->success = "Your feedback has been sent successfully!";
            $this->dispatch('resetSendButton'); // Reset button via Livewire event
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('resetSendButton'); // Ensure button resets even on validation fail
            throw $e; // Re-throw to show errors
        }
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
