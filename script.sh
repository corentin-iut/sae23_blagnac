#!/bin/bash

# Informations de connexion à la base de données MySQL
host=lhcp3349.webapps.net
user=iv5g2mc0_admin
password=Motdepasse31!
port=3306
database=iv5g2mc0_sae21

# Callback exécutée lors de la connexion au broker MQTT
on_connect() {
    echo "Connexion au broker MQTT établie avec le code de résultat : $1"
    # S'abonner aux topics lors de la connexion
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/E001/data" &
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/E105/data" &
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/B202/data" &
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/B203/data" &
}

# Callback exécutée lors de la réception d'un message MQTT
on_message() {
    echo "Message reçu sur le topic $1:"
    payload="$2"

    # Extraction des champs requis
    temperature=$(echo "$payload" | jq -r '.[0].temperature')
    room=$(echo "$payload" | jq -r '.[1].room')
    building=$(echo "$payload" | jq -r '.[1].Building')
    devEUI=$(echo "$payload" | jq -r '.[1].devEUI')

    # Récupération de l'heure et la date actuelles
    horaire=$(date +"%H:%M:%S")
    date=$(date +"%d/%m/%Y")

    # Insertion des données dans la base de données
    query="INSERT INTO MESURE (date, horaire, valeur, capteur) VALUES ('$date', '$horaire', '$temperature', '$devEUI')"
    mysql -h "$host" -u "$user" -p"$password" -P "$port" -D "$database" -e "$query"

}

# Connexion au broker MQTT et configuration des callbacks
mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "#" -v | while read -r line; do
    topic=$(echo "$line" | awk '{print $1}')
    message=$(echo "$line" | awk '{print $2}')
    case "$topic" in
        "Student/by-room/E001/data")
            on_message "$topic" "$message"
            ;;
        "Student/by-room/E105/data")
            on_message "$topic" "$message"
            ;;
        "Student/by-room/B202/data")
            on_message "$topic" "$message"
            ;;
        "Student/by-room/B203/data")
            on_message "$topic" "$message"
            ;;
        *)
            ;;
    esac
done