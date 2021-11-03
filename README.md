# Neos-Master

## Laden der Abhängigkeiten
composer install

## Server local starten
./flow server:run

## Cache löschen
Dev: ./flow flow:cache:flush

## Flow Hilfe
./flow help

## Verzeichnis wechseln
cd ./Wilde-Bluete

## SCSS Compilation
mit Prepros, die Files liegen unter: ./DistributionPackages/WG.Site/Resources/Public/Frontend/foundation-sites
in Prepros das Verzeichnis WG.Site importieren!!!

## Datenbank
für die Entwicklung über MAMP hosten

## How to
Grundkurs auf YT: https://www.youtube.com/playlist?list=PLmJYGBHR4uXEpFl-8vL9yaph6R5pMckMq
Rendering: https://www.youtube.com/watch?v=25VqmZ8Dlgw

# Installation bei einem Hoster
## Vorraussetzungen
- PHP 7.4 oder höher
- 1 Datenbank (utf8mb4)
- Composer muss installiert sein
- Git muss installiert sein
- Zip muss installiert sein
- SSH muss aktiviert sein

## Schritte für die Installation
- Git pull "Paketadresse"
- composer install
- ./flow server:run
- Domain in das Web Verzeichnis
- Datenbank Setup über Domainaufruf

## Kopieren von Daten
- https://neos.readthedocs.io/en/stable/References/CommandReference.html?highlight=import#neos-neos-site-export
- ./flow  site:export --package-key "WG.Site"
- Der Inhalt liegt dann in Resources/Private/Content -> Per FTP in das gleiche Verzeichnis
- ./flow  site:import --package-key "WG.Site"