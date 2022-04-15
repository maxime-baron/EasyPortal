#include <AFMotor.h> // Bibliotheque pour gerer l'actionnement de moteur avec une carte Iduino motor control.

int IRsensor = 32; // Capteur infrarouge.

AF_DCMotor moteur(1);  // Constructeur pour un moteur de type DC (numero de port M1).

// Afficheur des états des bouton poussoir des capteurs de fin de course.

const int limitSwitchG = 26;     // Port 26.
const int limitSwitchD = 27; // Port 27.

// Etat du bouton poussoir initialisé a zéro.
int limitSwitchStateG; // Gauche.
bool limitSwitchStateD; // Droite.


void setup() {

  Serial.begin(9600);
  pinMode (IRsensor, INPUT); // Initialisation du capteur infrarouge

  pinMode(limitSwitchG, INPUT); // Initialisation du capteur Gauche.
  pinMode(limitSwitchD, INPUT); // Droite

  
  moteur.setSpeed(250); // Applique une vitesse au moteur.

  moteur.run(RELEASE); // Arrête le moteur.
}

void loop() {

  limitSwitchStateD = digitalRead(limitSwitchD); // Etat du capteur de fin de course de droite.
  limitSwitchStateG = digitalRead(limitSwitchG); // Etat du capteur de fin de course de gauche.


  int value = digitalRead (IRsensor); // Valeur du capteur infrarouge.
  Serial.println(value); // Valeur de base initialisée a 0.
  if (value == 0 && limitSwitchStateG != 0) // Si la valeur est a 0 et que le capteur de fin de course de gauche est different de l'etat 0.
  {
    Serial.print("Ouverture du portail\n");
    moteur.run(BACKWARD); // Le moteur s'arrete.
    

  }
  else if (limitSwitchStateG == 0 && value == 0) // Si la valeur du capteur de fin de course de gauche est a 0 et que la valeur est a 0.
  { Serial.print("Fermeture du portail\n"); 
    moteur.run(RELEASE); // Le moteur s'arrete.
    delay(5000);
    
  }

  else if (limitSwitchStateG == 0 && value == 1) // Si la valeur du capteur de fin de course de droite est a 0 et que la valeur est a 1.
  {
    moteur.run(FORWARD); // Le moteur va de l'avant.
  }

  else if (limitSwitchStateD == 0 && value == 1) // Si la valeur du capteur de fin de course de droite est a 0 et que la valeur est a 1.
  {
    delay(100);
    moteur.run(RELEASE); // Le moteur s'arrete.
  }
}
