#!/bin/bash

# Informations de connexion à la base de données MySQL
host=fdb1027.eohost.com
user=4210695_sae23
password=motdepasse31
port=3306
database=4210695_sae23  # Remplacez "votre_base_de_donnees" par le nom de votre base de données

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
    date=$(date +"%Y-%m-%d")

    # Insertion des données dans la base de données
    query="INSERT INTO MESURE (date, horaire, valeur, capteur) VALUES ('$date', '$horaire', '$temperature', '$devEUI')"
    mysql -h "$host" -u "$user" -p"$password" -P "$port" "$database" -e "$query"
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
