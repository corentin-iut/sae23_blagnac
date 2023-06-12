#!/bin/bash

# MySQL database connection information
host=lhcp3349.webapps.net
user=iv5g2mc0_admin
password=Motdepasse31!
port=3306
database=iv5g2mc0_sae21

# Function executed when connecting to the MQTT broker
on_connect() {
    echo "Connection to the MQTT broker established with result code: $1"
    # Subscribing to topics upon connection
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/E001/data" &
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/E105/data" &
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/B202/data" &
    mosquitto_sub -h mqtt.iut-blagnac.fr -p 1883 -t "Student/by-room/B203/data" &
}

# Function executed upon receipt of an MQTT message
on_message() {
    echo "Message received on topic $1:"
    payload="$2"

    # Extraction of required fields
    temperature=$(echo "$payload" | jq -r '.[0].temperature')
    room=$(echo "$payload" | jq -r '.[1].room')
    building=$(echo "$payload" | jq -r '.[1].Building')
    devEUI=$(echo "$payload" | jq -r '.[1].devEUI')

    # Getting current time and date
    horaire=$(date +"%H:%M:%S")
    date=$(date +"%d/%m/%Y")

    # Inserting the data into the database
    query="INSERT INTO MESURE (date, horaire, valeur, capteur) VALUES ('$date', '$horaire', '$temperature', '$devEUI')"
    mysql -h "$host" -u "$user" -p"$password" -P "$port" -D "$database" -e "$query"

}

# "Connecting to the MQTT broker and setting up callbacks based on the topic + creating the "topic" and "message" variables using the "awk" command"
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
