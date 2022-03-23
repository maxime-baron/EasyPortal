 #include <AFMotor.h> // Bibliotheque pour gerer l'actionnement de moteur avec une carte Iduino motor control.
  
  AF_DCMotor moteur(1);  // Constructeur pour un moteur de type DC (numero de port M1)
  
  void setup() {
    
    Serial.begin(9600);
    Serial.println("Actionnement du moteur");
  
    moteur.setSpeed(250); // Applique une vitesse au moteur.
    moteur.run(RELEASE); // Arrête le moteur.
  }
  
  void loop() {
    
  uint8_t i; // Chaine de caractère.
  moteur.run(FORWARD); // Le moteur tourne vers l'avant.
  
  for (i=0; i<50; i++) {
   moteur.setSpeed(i); // Applique une vitesse au moteur.
   delay(10);
  }
  
    for (i=255; i!=0; i--) {
     moteur.setSpeed(i); // Applique une vitesse au moteur.
     delay(10);
    }
  
  moteur.run(BACKWARD); // Le moteur tourne de manière inversé.
  
  for (i=0; i<50; i++) {
   moteur.setSpeed(i); // Applique une vitesse au moteur.
   delay(10);
  }
  
    for (i=255; i!=0; i--) {
     moteur.setSpeed(i); // Applique une vitesse au moteur.
     delay(10);
    }
  
  moteur.run(RELEASE); // Arrête le moteur.
  delay(1000);
  }
