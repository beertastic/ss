# Simple Stream
## Tris Pretty

Quick intro.<br>
I've used my experience tinkering with Kodi to plan my data structure (though Kodi drives me mad sometimes). I tried to make it as 'fluid' as posible, ensuring that shows can be shared between channels and the schedule was random and more natural. Anyhoo, enjoy and feel free to reach out if you need a quick explanation of my thought process, beyong this readme.<br> Which leads us to......

- Set up
- api calls
- General data flow
- Notes
- TODOs


###Set up
1. `composer install`
2. `php artisan migrate --seed`
3. I've left in the generic Laravel migrations
4. Postman file found in root: Tris_SS.postman_collection.json
4. DB EER png found in root root: DATA_EER.png

###api calls
1. `api/v1/channels`
2. `api/v1/channels/{cuid}/{date}/{timezone}`
3. `api/v1/channels/{cuid}/programmes/{puid}`

###General data flow
1. 4 main data areas: Channel, Show, Episode, Schedule
2. Channel is fairly self contained (hard coded data in seeder).
3. Show is the list of shows that the channel can pick from (hard coded data in seeder).
4. Episode is specific episode data, filterable by season and episode number (Seeded with FAKER data) Seeder loops through shows, and adds random number of seasons/episodes.
5. Schedule is a glorified pivot table that mirrors up a channel and a specific episode (with an air date based on last show ending and the duration), from which we can use eloquent relationships to ascertain and required data. (Seeder loops through channels, and adds random episode, with a 3 min gap after each show. )
6. Calls are made to relevant Controllers and eloquent does its magic!
7. Due to FAKER episode data, please use IDs generated from APi calls 1 and 2, to populate APi call No 3
8. Iddeally, each returned Json would have a master node with key info, but for now, this is raw data

###Notes

Assumptions:<br>
1. The system here is for a SINGLE company who manage several channels via their own admin area.<br>
2. Model files (App\Models) I've not used comments as they're really self explanitory
3. I've added a 'v1' to the api call URL (see api routes file). Based off experience, I feel it's vital to have that as default


Data:<br>
1. The 3rd Api call, specifies the channel uid. I've left it in (to not break any systems you'll use this to test on), but my data structure doesn't require it as the Schedule model (which is 'technically' a pivot table) handles all the realtionships.
2. Episodes are seeded with a random duration from 1200 to 2700 seconds (I prefer unix timestamp and seconds as it's easier and less processor time to index timestamps (ints) than dates)
3. Shows are 'floating' and don't belong to a channel, so various channels can share shows if needed.
4. Episodes DO belong to a show however.
5. The schedule table is used to get episode data (3rd call), as a channel might repeat an episode and I needed a way to get data for THAT instance of the viewing, for the third Api call
6. CHANNEL AND SHOW are hard coded during seed. Episodes are created using FAKER.

Limitations
1. Channel, show and episode images would be stored on an S3 bucket with a view that the end client would cache on the users end device. To that end, I've hard coded links to external images that are simply place holders.

Challenges that stumped me (but I enjoyed!):
1. The last 2 routes were similar enough for me to struggle with. I had to learn how to check what TYPE of data the variable was. In this case, was the 3rd url node a DATE, which I checked with a Regular Exp'.
2. Time zone really stumped me to set up correctly in the time alloted. It's still a var in the route and I have ideas about how to fix it, but not enough time.

###TODOs
1. Add categories (a separate master table and a pivot table so shows can have multipe categories)
2. Make a better data flow to distinguish moves from TV shows (movies will need better logic management and probably want cast list, more images, trailer link etc)
3. Timezone management. I started to try it with a 'simple' int to plus/minus hours in the Api URL. I couldn't get it working in time, but started to investigate Carbon as that can handle it apparently.
4. Add consistent try/catch.. um, everywhere!
5. Add foreign/index keys to migrations to maintain better cascade flow and indexing if needed.
6. Allow admin user to specify a time gap after a show in the schedule, then move all other shows if required.


