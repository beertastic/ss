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
1. `channels`
2. `channels/{cuid}/{date}/{timezone}`
3. `channels/{cuid}/programmes/{puid}`

###General data flow

###Notes

Assumptions:<br>
1. The system here is for a SINGLE company who manage several channels via their own admin area.<br>
2. Model files (App\Models) I've not used comments as they're really self explanitory
3. I've added a 'v1' to the api call URL (see api routes file). Based off experience, I feel it's vital to have that as default


Data:<br>
1. The 3rd Api call, requires the channel uid. I've left it in, but my data structure doesn't require it as the Schedule model (which is 'technically' a pivot table) handles all the realtionships.
2. Episodes are seeded with a random durtation from 1200 to 2700 seconds (I prefer unix timestamp and seconds as it's easier and less processor time to index timestamps (ints) than dates)
3. Shows are 'floating' and don't belong to a channel, so various channels can share shows if needed.
4. Episodes DO belong to a show however.
5. The schedule table is used to get episode data (3rd call), as a channel might repeat an episode and I needed a way to get data for THAT instance of the viewing, for the third Api call

Limitations
1. Channel, show and episode images would be stored on an S3 bucket with a view that the end client would cache on the users end device. To that end, I've hard coded links to external images that are simply place holders.

Challenges that stumped me (but I enjoyed!):
1. The last 2 routes were similar enough for me to struggle with. I had to learn how to check what TYPE of data the variable was. In this case, was the 3rd url node a DATE, which I checked with a Regular Exp'.

###TODOs
1. Add categories (a separate master table and a pivot table so shows can have multipe categories)
2. Make a better data flow to distinguish moves from TV shows (movies will need better logh management and probably want cast list etc)
3. Timezone management. I started to try it with a 'simple' int to plus/minus hours in the Api URL. I couldn't get it working in time, but started to investigate Carbon as that can handle it apparently.
4. Add consistent try/catch.. um, everywhere!
5. Add foreign/index keys to migrations to maintain better cascade flow and indexing if needed.


