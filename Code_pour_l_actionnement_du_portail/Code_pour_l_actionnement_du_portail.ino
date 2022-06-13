#include <Wire.h>
#include <AFMotor.h> // Bibliotheque pour gerer l'actionnement de moteur avec une carte Iduino motor control.*


int t; // Reception du Raspberry
int IRsensor = 32; // Capteur infrarouge.
int value; // La valeur

AF_DCMotor moteur(1);  // Constructeur pour un moteur de type DC (numero de port M1).

// Afficheur des états des bouton poussoir des capteurs de fin de course.

const int limitSwitchG = 26;     // Port 26.
const int limitSwitchD = 27; // Port 27.

// Etat du bouton poussoir initialisé a zéro.
int limitSwitchStateG; // Gauche.
int limitSwitchStateD; // Droite.


void setup() {
  Serial.begin(9600);
  pinMode (IRsensor, INPUT); // Initialisation du capteur infrarouge
  pinMode(35, OUTPUT); // VERT

  pinMode(limitSwitchG, INPUT); // Initialisation du capteur Gauche.
  pinMode(limitSwitchD, INPUT); // Droite

  Wire.begin(8); // Broche utilisé pour l'adresse I2C
  Wire.onReceive(receiveData); // Recoit une donnée venant de l'I2C

  digitalWrite(35,0);
  delay(1000);
  moteur.setSpeed(250); // Applique une vitesse au moteur.
  moteur.run(RELEASE); // Arrête le moteur.
}

void receiveData(int bytecount) // Compte le nombre d'octets que l'Arduino recoit
{
  for (int i = 0; i < bytecount; i++) { // Boucle "for" permettant de compte le nombre d'octets que l'Arduino recoit
    t = Wire.read(); // Affiche le meme resultat envoyé de la Raspberry
    Serial.println(t); // Affiche le contenu du message
  }
}

void loop() {
  //Serial.print(t);
    digitalWrite(35, LOW);
  while (t == 255) { // Si 225 est recu, la valeur devient l'
      digitalWrite(35, HIGH);
    Serial.print("Reçoit : ");
    Serial.println(t);
    limitSwitchStateD = digitalRead(limitSwitchD); // Etat du capteur de fin de course de droite.
    limitSwitchStateG = digitalRead(limitSwitchG); // Etat du capteur de fin de course de gauche.
    Serial.println(limitSwitchStateD); // Depart 0 = activé
    Serial.println(limitSwitchStateG); // Depart 1 = desactivé
    value = digitalRead (IRsensor); // Valeur du capteur infrarouge.
    Serial.print("Capteur : ");
    Serial.println(value); // Valeur de base initialisée a 0.
    moteur.run(BACKWARD); // Inverse des aiguilles montre
    while (limitSwitchStateG == 1) { // Tant le capteur de fin de course gauche passe a l'etat 1
      limitSwitchStateG = digitalRead(limitSwitchG); // 
      
    }

    if (limitSwitchStateG == 0) { // Si le capteur de fin de course gauche passe a l'etat zero)
      moteur.run(RELEASE); // Le moteur s'arrête
    }

    while (value == 1) { // Si la valeur 
      value = digitalRead(IRsensor);
      Serial.print(value);
    }
    moteur.run(RELEASE); // Le moteur s'arrete
    Serial.print("on est ici");
    delay(2000);
    Serial.println("2sec aprés");
    moteur.run(FORWARD); //Sens des aiguilles d'une montre, le moteur va de l'avant.
    limitSwitchStateD = digitalRead(limitSwitchD);
    while (limitSwitchStateD == 1) {
      limitSwitchStateD = digitalRead(limitSwitchD); // Lit quand il passe a 1
      Serial.print(limitSwitchStateD);
       moteur.run(FORWARD); // Le moteur va de l'avant.
    }
    moteur.run(RELEASE); // Arret.
    t=0; // On reinitialise
  }
}
