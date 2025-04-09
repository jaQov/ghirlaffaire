typedef enum { pensif, attendant, mangeant } e_ph;
e_ph etat[5] = {pensif, pensif, pensif, pensif, pensif}; // état initial de tous les philosophes

Semaphore S[5] = {0, 0, 0, 0, 0}; // sémaphores individuels pour chaque philosophe
Semaphore mutex = 1;              // sémaphore d’exclusion mutuelle

int Droite(int i) { return (i == 0) ? 4 : i - 1; }
int Gauche(int i) { return (i + 1) % 5; }


Processus Philosophe(i)
Début
    Tant que vrai faire
        Penser();

        // Essayer de manger
        P(mutex); // entrer dans la section critique

        // Si un des voisins mange, attendre
        Si (etat[Droite(i)] == mangeant) ou (etat[Gauche(i)] == mangeant) alors
            etat[i] = attendant;
            V(mutex); // quitter la section critique
            P(S[i]);  // bloquer jusqu’à ce qu’on l’autorise à manger
        Sinon
            etat[i] = mangeant;
            V(mutex); // quitter la section critique
        Fin Si

        Manger();

        // Terminé de manger, relâche les fourchettes
        P(mutex);

        etat[i] = pensif;

        // Vérifie si le voisin de droite peut manger maintenant
        Si (etat[Droite(i)] == attendant) et (etat[Droite(Droite(i))] != mangeant) alors
            etat[Droite(i)] = mangeant;
            V(S[Droite(i)]); // le réveiller
        Fin Si

        // Vérifie si le voisin de gauche peut manger maintenant
        Si (etat[Gauche(i)] == attendant) et (etat[Gauche(Gauche(i))] != mangeant) alors
            etat[Gauche(i)] = mangeant;
            V(S[Gauche(i)]); // le réveiller
        Fin Si

        V(mutex); // sortir de la section critique
    Fin Tant que
Fin
