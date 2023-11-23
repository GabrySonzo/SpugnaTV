# SpugnaTV

PROBLEMA
Ho una pessima memoria, non riesco a tenere traccia dei film/serie che sono usciti, che ho visto, che devo vedere e della mia opinione su di essi.

DESCRIZIONE
Webapp per tenere traccia di serie/film usciti (clone di TvTime). App che contiene tutte le informazioni sui i film usciti (regista, attori, dove vederli ecc..) con la possibilita di contrassegnare i film visti e di lasciare la propria recensione

FUNZIONALITÀ
- registrazione utente
- autenticazione utente
- recupero password
- modifica utente
- elimina utente
- visualizzazione statistiche utente
- inserimento film
- inserimento regista
- inserimento attore
- ricerca per nome/regista
- funzione sfoglia dal catalogo di film
- visualizzazione delle informazioni di un film
- visualizzazione delle informazioni di un regista
- creazione di una lista personalizzata
- modifica lista personalizzata
- eliminazione lista personalizzata
- inserimento/rimozione di un film da una lista personalizzata
- contrassegnamento di un film come visto
- visulizzazione delle liste di un utente
- inserimento di una valutazione personale in stelle
- inserimento di una valutazione personale come commento
- funzione che estrae un film random tra quelli da vedere

MODELLO ER
![Alt text](modello/er.png)

SCHEMA RELAZIONALE

Utente (email*, username, password, foto_profilo)
Lista(id*, nome, utente_email)
Film (id*, titolo, Inno, durata, genere, trama, locandina, banner) Attore (id, nome, cognome, foto)
Regista (id*, nome, cognome, data_nascita, data_morte, descrizione, foto)
Recensione(id*, n_stelle, commento, utente_email, film_id)
Comprende (lista id*, film id*)
Recita (attore id*, film id*)
Dirige (regista id*, film id*)

MOCKUP

schermata di login
![Alt text](modello/image.png)

schermata di registrazione
![Alt text](modello/image-6.png)

schermata registrazione film
![Alt text](modello/image-7.png)

schermata registrazione regista
![Alt text](modello/image-8.png)

schermata registrazione cast
![Alt text](modello/image-9.png)

schermata ricerca
![Alt text](modello/image-1.png)

visualizzazione di una lista
![Alt text](modello/image-2.png)

visualizzazione scheda di un regista
![Alt text](modello/image-3.png)

visualizzazione scheda di un film
![Alt text](modello/image-4.png)

visualizzazione profilo utente
![Alt text](modello/image-5.png)