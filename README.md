# Simple Stream

Covered in this Doc:

- Set up
- api calls
- General data flow
- Notes
- TODOs


###Set up
1. `composer install`
2. `php artisan migrate --seed`
3. 

###api calls

###General data flow

###Notes
Assumptions:<br>
1. The system here if for a SINGLE company who manage several channels via their own admin area.<br>
2. Shows are 'floating' and don't belong to a channel, so various channels can share shows if needed.
3. Episodes DO belong to a who however.

Limitations
1. Channel, show and episode images would be stored on an S3 bucket with a view that the end client would cahce on the users end device. To that end, I've hard coded links to external images that are simply place holders.


###TODOs
1. Add categories (a separate master table and a pivot table so shows can have multipe categories)
2. Make a better data flow to distinguish moves from TV shows (movies will need better logh management and probably want cast list etc)
3. 
