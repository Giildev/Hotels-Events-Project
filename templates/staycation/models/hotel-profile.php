<?php  require(SYSBASE."templates/".TEMPLATE."/common/header.php");


$hotel = $db->query("
SELECT DISTINCT
n.id AS neigborhood_id,
n.title AS neigborhood_title,
n.alias AS neigborhood_alias,
h.id AS hotel_id,
h.title AS hotel_title,
h.alias AS hotel_alias,
h.descr AS hotel_descr,
h.address AS hotel_address,
h.facilities AS hotel_facilities,
h.benefit AS hotel_benefit,
h.perk AS hotel_perk,
h.things AS hotel_things,
h.inside AS hotel_inside,
h.lat AS hotel_lat,
h.lng AS hotel_lng,
h.from_date AS hotel_from_date,
h.to_date AS hotel_to_date,
hf.file as hotel_file,
hf.id as hotel_file_id
FROM pm_neighborhood AS n
INNER JOIN pm_hotel AS h
INNER JOIN pm_hotel_file AS hf ON n.id = h.id_neighborhood
AND h.id = hf.id_item
WHERE h.id= ".$_GET['id']."
AND h.featured_enable =1
AND h.lang = ".LANG_ID."
AND hf.lang = ".LANG_ID."
");


$galleryImg = [];
foreach ($hotel as $key => $value) {
  $hotel_id = $value['hotel_id'];
  $hotel_title = $value['hotel_title'];
  $hotel_address = $value['hotel_address'];
  $hotel_benefit = $value['hotel_benefit'];
  $hotel_perk = $value['hotel_perk'];
  $hotel_things = $value['hotel_things'];
  $hotel_inside = $value['hotel_inside'];
  $hotel_checkin = $value['hotel_from_date'];
  $hotel_checkout = $value['hotel_to_date'];
  $hotel_lat = $value['hotel_lat'];
  $hotel_lng = $value['hotel_lng'];
  $neigborhood_title = $value['neigborhood_title'];
  $hotel_file_id = $value['hotel_file_id'];
  $hotel_file = $value['hotel_file'];
  $hotel_descr = $value['hotel_descr'];
  $hotel_facilities = $value['hotel_facilities'];
  array_push($galleryImg, array("fileId" => $value['hotel_file_id'], "fileName" => $value['hotel_file']));
}

$facility = $db->query("
SELECT
f.id AS facility_id,
f.name AS facility_name,
ff.file as facility_file,
ff.id as facility_file_id,
ff.id_item as facility_file_id_item
FROM pm_facility AS f
INNER JOIN pm_facility_file AS ff ON f.id = ff.id_item
AND f.id IN(".$hotel_facilities.")
AND f.lang =".LANG_ID."
AND ff.lang =".LANG_ID."
");

$benefit = $db->query("
SELECT *
FROM  pm_benefit
WHERE id
IN (".$hotel_benefit.")
");

$rooms = $db->query("
SELECT
r.id AS room_id,
r.id_hotel AS room_id_hotel,
r.title AS room_title,
r.descr AS room_descr,
rf.id AS room_file_id,
rf.id_item AS room_file_id_item,
rf.file AS room_file_file
FROM pm_room AS r
INNER JOIN pm_room_file AS rf ON r.id = rf.id_item
WHERE r.id_hotel = ".$_GET['id']."
AND r.lang = ".LANG_ID."
AND rf.lang = ".LANG_ID."
");


// Likes count
$like_res = $db->query("
SELECT COUNT( * ) as likes
FROM  `pm_like`
WHERE `id_hotel` = ".$_GET['id']."
AND `like_count` = 1
");
foreach ($like_res as $key => $like) {
  $likes = $like['likes'];
}

// Dislikes count
$dislike_res = $db->query("
SELECT COUNT( * ) as dislike
FROM  `pm_like`
WHERE `id_hotel` = ".$_GET['id']."
AND `like_count` = 0
");
foreach ($dislike_res as $key => $dislike) {
  $dislike = $dislike['dislike'];
}

// Includes
$includes = $db->query("
SELECT *
FROM `pm_service`
WHERE `lang` = ".LANG_ID."
");
?>

<input type="hidden" id="session" name="session" value="<?php print_r($_SESSION['user']['login']); ?>">
<div class="page" id="page">
  <div class="head_bck" data-color="#292929"  data-opacity="0.5"></div>
  <?php  require(SYSBASE."templates/".TEMPLATE."/common/hotel-profile-header.php");?>
  <div class="container-fluid">
      <div class="row" style="padding-top:0">
          <div class="bordered_block col-md-12 grey_border">
              <div class="container-fluid" style=
              "background-color:#fff; height:auto; margin: 30px 30px;">
                  <div class="row">
                      <!--Sidebar-->
                      <div class="col-md-9 col-xs-12">
                          <div class="row" style="background-color:#f8f8f8; padding-bottom: 25px;padding-top:0">
                              <div class="col-md-12" style="padding:0">

                                  <h3 class="text-center teal title-wrapper-border yellow" ><img src="images/icons/amenities/perks.png"><?php echo $hotel_title; ?> | Staycation Perks</h3>
                                  <hr style="margin: 10px 33% 20px;">
                                  <div class="row"><div class="col-md-6">
                                          <ul style="color: #3d3834;margin: 0px 10px 50px 36px;padding: 0;list-style-type: disc;list-style-position: outside;line-height: 25px;">
                                              <?php echo $hotel_perk; ?>
                                          </ul>
                                      </div>
                                      <div class="col-md-6">
                                          <!-- <ul style="color: #3d3834;margin: 0px 10px 50px 36px;padding: 0;list-style-type: disc;list-style-position: outside;line-height: 25px;">
                                            <li class="list-checkmark teal">Upgrade based on availability at time of check-in.</li>
                                            <li class="list-checkmark teal">Uber or Lyft credit of up to $20 per room.</li>

                                          </ul> -->
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="row" style="padding-bottom: 25px;padding-top: 20px;">
                              <div class="col-md-6" style="border-right: 1px solid #f1f1f1;">
                                  <h3 style="margin-top:30px;" class="text-center">Amenities</h3>
                                  <div class="row list-container"><div class="col-md-6">
                                          <ul class="amenities-list">
                                              <?php foreach ($facility as $key => $value) {?>
                                                  <li class="list-checkmark teal"><?php echo $value['facility_name']; ?></li>
                                              <?php } ?>
                                          </ul>
                                      </div>
                                      <div class="col-md-6">
                                          <ul class="amenities-list">
                                          </ul>
                                      </div>
                                  </div>
                                  <p></p>
                              </div>
                              <div class="col-md-6" style="/* border-left: 1px solid #f1f1f1; */">
                                  <h3 style="margin-top:30px" class="text-center">Benefits</h3>
                                  <div class="row list-container">
                                      <div class="col-md-6">
                                          <ul style="color: #3d3834;margin: 0 0 0 25px;padding: 0;list-style-type: disc;list-style-position: outside;line-height: 25px;">
                                              <?php
                                              foreach ($benefit as $key => $value) {?>
                                                  <li class="list-checkmark teal"><?php echo $value['name'] ?></li>
                                              <?php } ?>
                                          </ul>
                                      </div>
                                      <div class="col-md-6">
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row" style="background-color:#f8f8f8;margin-bottom:50px;">
                              <div class="col-md-12" style="padding:0;">
                                  <h3 class="text-center teal title-wrapper-border multicolor-line" ><img src="images/icons/amenities/scoop.png">Inside Scoop</h3>
                                  <div class="row"><div class="col-md-12">
                                          <ul style="color: #3d3834;margin: 0 36px 0 36px;padding: 0;list-style-type: disc;list-style-position: outside;line-height: 25px;">
                                              <?php echo $hotel_inside; ?>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="col-md-12 bottom-closing-border yellow"></div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-8">
                                  <h3 style="margin-top: 0;">Room
                                      Availability</h3>
                              </div>
                              <div class="col-md-4">
                                  <button
                                      id= "roomAvailability"
                                      aria-controls= "room-availability"
                                      aria-expanded= "false"
                                      class= "btn btn-default collapsed"
                                      data-target="#room-availability"
                                      data-toggle="collapse"
                                      style= "height: 35px;width: 145px;border: 0;background-color: #00a0ae;color: #fff !important;font-size: 100%;"
                                      type="button">View Room Options</button>
                              </div>
                          </div>
                          <div class="row">
                              <div aria-expanded="false" class="collapse" id="room-availability" style= "height: 0px;">
                                  <div class="room-selector">
                                      <div class= "room-selector-placeholder" id= "room-list">
                                          <div class="room-list">
                                              <div class="table-container">
                                                  <?php foreach ($rooms as $key => $value) {?>
                                                      <div class="comments-content">
                                                          <div class="answer">
                                                              <img alt="" class= "img-comments" src=<?php echo DOCBASE."medias/room/big/".$value['room_file_id']."/".$value['room_file_file']; ?>>
                                                              <div class="content-cmt">
                                                                  <div class="row">
                                                                      <div class="col-md-10">
                                                                          <span class="name-cmt"><?php echo $value['room_title'] ?></span>
                                                                          <p class=""><?php echo $value['room_descr'] ?></p>
                                                                      </div>
                                                                      <div class="col-md-2">
                                                                          <div class="" style="margin-top:10px"> <button class="btn btn-default" style="height: 45px;width: 92px;border: 0;background-color: #ffbf3b;color: #fff !important;font-size: 120%;">Book</button>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>

                                                  <?php } ?>
                                              </div>
                                          </div>
                                      </div>

                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <ul class="nav nav-tabs" id="myTab" role=
                              "tablist" style=
                                  "margin-top: 50px;/* clear: both; */">
                                  <li class="active" role="presentation">
                                      <a aria-controls="details"
                                         aria-expanded="false" data-toggle=
                                      "tab" href="#details" id=
                                         "details-tab" role=
                                         "tab">Details</a>
                                  </li>
                                  <li class="" role="presentation">
                                      <a aria-controls="area"
                                         aria-expanded="false" data-toggle=
                                      "tab" href="#area" id="area-tab"
                                         role="tab">Area</a>
                                  </li>
                                  <li class="" role="presentation">
                                      <a aria-controls="gallery"
                                         aria-expanded="false" data-toggle=
                                      "tab" href="#gallery" id=
                                         "gallery-tab" role=
                                         "tab">Gallery</a>
                                  </li>
                              </ul>


                              <div class="tab-content" id="myTabContent">
                                  <div aria-labelledby="details-tab"
                                       class="tab-pane fade active in" id=
                                  "details" role="tabpanel" style=
                                       "padding:40px;border-left: 1px solid #ddd; height: auto;border-right: 1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">

                                      <div class="col-wrapper" id=
                                      "review">
                                          <div class="col-wrapper" id=
                                          "review-items">
                                              <div class="review-item clearfix first">
                                                  <h3 class="tenor">
                                                      Things to know</h3>
                                                  <div class="description">
                                                      <ul>
                                                          <?php echo $hotel_things; ?>
                                                      </ul>
                                                  </div>
                                              </div>


                                              <div class="review-item clearfix">
                                                  <h3 class="tenor">Includes</h3>
                                                  <div class="description">
                                                      <ul>
                                                          <?php foreach ($includes as $key => $value) {?>
                                                              <li class="list-checkmark red"><?php echo $value['title'] ?></li>
                                                          <?php } ?>
                                                      </ul>
                                                  </div>
                                              </div>
                                              <div class=
                                                   "review-item clearfix">
                                                  <h3 class="tenor">Check-in & Check-out</h3>
                                                  <div class=
                                                       "description">
                                                      <ul>
                                                          <li style="list-style:none;">Check-in: <?php echo $hotel_checkin; ?></li>
                                                          <li style="list-style:none;">Check-out: <?php echo $hotel_checkout; ?></li>
                                                      </ul>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div aria-labelledby="area-tab" class="tab-pane fade" id="area" role="tabpanel" style="padding:40px;border-left: 1px solid #ddd; height: auto;border-right: 1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                                      <!--  Comments -->
                                      <section class="">
<!--                                          <div id="map_canvas"  style="width:100%" >-->
                                              <div id="map" style="width: 400px; height: 300px"></div>
<!--                                          </div>-->
                                          <!-- <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJ-fs-zWaz2YgRDWTalzyCTb8&key=AIzaSyBvliF4e_9AHJf5yuAIHzJl6UuKf0airSo" allowfullscreen></iframe> -->
                                      </section>
                                      <!-- End Comments -->
                                  </div>
                                  <div aria-labelledby="reviews-tab"
                                       class="tab-pane fade" id="reviews"
                                       role="tabpanel" style=
                                       "padding:40px;border-left: 1px solid #ddd; height: auto;border-right: 1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                                      <!--  Comments -->


                                      <section class="comments clearfix">
                                          <div class="content-section">
                                              <h2 class="tenor">
                                                  TripAdvisor Traveler
                                                  Rating</h2>


                                              <div class=
                                                   "reviews-meta clearfix">
                                                  <div class=
                                                       "trip-owl-icon">
                                                  </div>


                                                  <div class="ta-rating">
                                                      <span class=
                                                            "icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span>
                                                  </div>
                                                  | <span class=
                                                          "how-good"><strong>5.0
                                                          Excellent</strong></span>
                                                  | 27 Reviews
                                              </div>


                                              <div class="ta-review odd">
                                                  <div class=
                                                       "review-title">
                                                      <h2>“Great Facility
                                                          - service, not so
                                                          much...”</h2>
                                                  </div>


                                                  <div class="clearfix">
                                                      <div class=
                                                           "ta-rating">
                                                          <span class=
                                                                "icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-zero"></span><span class="icon-zero"></span>
                                                      </div>
                                                      <span class=
                                                            "review-publish-date">Reviewed
                                                      4 days ago</span>
                                                  </div>


                                                  <div class=
                                                       "review-text"
                                                       data-full-text=
                                                       "As a frequent user of Trip Advisor, I feel a review of our stay at Zemi Beach Resort and Spa is important to others. I have now re-read the other reviews since our return home and wonder where those people stayed…&lt;br/&gt;&lt;br/&gt;This is a little lengthy, but bear with me. First, the resort is really amazing. The zigzag pool overlooking the beach is simply breathtaking, and the grounds are very well maintained (as one would expect from a very new resort). The design and décor of the rooms is modern and tasteful, and the beachfront views are simply amazing. The beach that the resorts sits on is potentially one of the best in the Caribbean – it really is amazing. The coral sand is unbelievable and the water is really as blue as any photo ever taken of the Caribbean. That pretty much covers everything positive about Zemi, the rest is downhill. &lt;br/&gt;&lt;br/&gt;Getting to Anguilla is fairly simple. We chose the $20 public ferry from St. Maarten which goes to the same dock as the private $85 charter that the hotel recommends. It was clean, easy, and only a 20 minute ride to the dock on Anguilla. Then it is a $26 cab ride to the hotel. Even though someone was at the ferry terminal holding a Zemi Resort sign, they basically hand you off to a driver that still needs to collect cab fare upon arrival to the resort (you would think based on the cost of a stay at the resort and the fact they claim to be a five-star resort, they could at least cover the trip to the property). Upon our arrival we were greeted by the typical Champagne and cool towels and friendly staff. We were earlier than check-in time, so they took our bags and drove us to breakfast via one of the many golf carts on the property. Once at breakfast we enjoyed a breathtaking view and had a fairly nice meal. After breakfast our room was ready and we were taken there by staff for a tour and explanation of room functionality. Then off to the pool. One of the first things we noticed was the lack of guest. During our 3 ½ day stay we saw no more than 20 other guest; It was almost eerie. We were able to get a lovely lounger by the pool and start relaxing. As we settled into vacation mode, we started to notice that the staff seemed a little untrained. They were extremely friendly, but their service left a bit to be desired. They were either all over you asking what you needed, or you could not find them at all. Many times during our three days by the pool, we had to walk to the bar to get a drink. Not really a big deal, but when you book a five-star resort, you expect five-star service. Even once you got someone to take your order, it seemed to take a fair amount of time to get a drink – which made no sense to us since the resort was basically empty. The amount of staff seemed ample, but the service seemed non-existent at times. Lunch was usually done at the pool, and once you were able to get someone to take an order, the food was ok. &lt;br/&gt;&lt;br/&gt;Upon our arrival we had chatted briefly with the manager of the resort. He was nice enough, but seemed to be awaiting other guest arrivals. Later that day we bumped into him at the pool and ask about a tour of the property and some of the larger units (after all they sell units). He assured is that would be no problem. We expected that he would contact us for an appointment since we were not on a schedule – never spoke to him or heard from any staff regarding a tour after that…&lt;br/&gt;&lt;br/&gt;Dinner was a complete different set of challenges. Even though they advertise multiple places to eat on the resort, while we were there only one restaurant was open for dinner – Stone. This is their fine dining restaurant. We were pretty disappointed in the service and the menu. Our first night we had a total of three wait staff at our table (each who seemed to have no clue what the last person had offered). Again, like at the pool, it was either staff over coverage or you could not find them. Salt, pepper, and butter always seemed to be a challenge to get to the table. The second night we ate off the resort, and we were glad to be off property where there were actually other people. On night three, we again submitted to dinner at Stone (since it was the only option without a $50+ dollar cab ride to civilization). One would expect five-star prices at a five-star resort; however, one would also expect five-star quality. This is where our disappointment lead us to laughter. It became so amusing to us that we were at this lovely resort, but yet trapped with our food choices. My girlfriend’s $22 cucumber salad was one small cucumber with a couple of onion shreds and really no flavor. We laughed at the fact that we paid $22 (not including the automatic tip which they add to all food tabs) for a cucumber. Then the real laugh came when I paid $47 for three “prawns.” Basically they were average size shrimp with a piece of bread in the middle. It became so humorous that we almost could not stop laughing. One note: the prices on the menus on the website do not match what you get at the table. &lt;br/&gt;The lack of activates was also disappointing. No live music, no dancing, no entertainment whatsoever. To top it off, every night that we went to the main gathering place of the hotel by the Rhum Room and the bar area, they were literally empty. No one was there. It felt awkward to sit there as one couple. Of all the resorts my girlfriend and I have been to, this was one of the nicest, yet most disappointing.&lt;br/&gt;&lt;br/&gt;Our last breakfast was the icing on the service cake. Our waitress greeted us and asked if we would like coffee. Our request for coffee was met with “It just started brewing.” Great – fresh, hot coffee. After approximately 10 minutes we received a pot of cold coffee and two cups. Based on flavor and temperature, this was yesterday’s “re-heated” coffee. &lt;br/&gt;&lt;br/&gt;On the day prior to check-out, guest services had inquired about our departure plans. We relayed them and they coordinated. The next morning, we got a letter confirming our plans, with one minor problem – they had scheduled the private $85 charter to return us to St. Maarten. No problem, we will stop on the way to breakfast at guest services to remind them we are taking the public charter. We did and she said no problem. Promptly at 11:00 we arrived at the lobby ready to check out. They handed us the settlement statement for review. Not only did they try to bill us for the private charter leaving the island, they had included a private charter arrival. So our bill was off by $340 ($85 per person, per trip). They even seemed upset that we wanted it off the bill. We got that issue resolved, but left feeling that they have probably done this to others before who did not catch the mistake. Had it just been the leaving charge, we might have thought it was a simple mistake, but to be billed or the arrival charter, which we never requested or used, it seemed less like a mistake and more intentional. Update – After getting home we still got a $170 charge on our credit card for the charter ferry – Unbelievable!!! Yet another call had to be made to straighten it out…&lt;br/&gt;&lt;br/&gt;At our departure, we noted a couple that we had seen around the pool at the front lobby. They said “hi” and got in a cab two minutes before us. Our cab arrived (all scheduled by the resort), and we proceeded to the ferry terminal. My girlfriend and I commented on the ride – “I bet they are going to the ferry terminal also.” As expected, they arrived 20 seconds before us. Why the hotel did not offer to let us split a cab is a bewilderment to me. It almost felt like they were just trying do provide business for the locals instead of services for their guest. &lt;br/&gt;&lt;br/&gt;We chatted with the other couple that had ridden in a different cab at the ferry terminal, and even another couple we had seen at the pool. Both couples had a very similar experience. They asked us if we would recommend Zemi to others. Our answer - Not at this time. It does not matter how fabulous the property is, if the service does not match, it’s a disappointment.">
                                                      As a frequent user of
                                                      Trip Advisor, I feel a
                                                      review of our stay at
                                                      Zemi Beach Resort and
                                                      Spa is important to
                                                      others. I have now
                                                      re-read the other
                                                      reviews since our
                                                      return home and wonder
                                                      where those people
                                                      stayed…<br>
                                                      <br>
                                                      This is a little …
                                                      <a class=
                                                         "show-full-review"
                                                         href="#">more</a>
                                                  </div>
                                              </div>


                                              <div class=
                                                   "ta-review even">
                                                  <div class=
                                                       "review-title">
                                                      <h2>“Boutique
                                                          hotel/Far from
                                                          restaurants/other
                                                          side of
                                                          island”</h2>
                                                  </div>


                                                  <div class="clearfix">
                                                      <div class=
                                                           "ta-rating">
                                                          <span class=
                                                                "icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-zero"></span>
                                                      </div>
                                                      <span class=
                                                            "review-publish-date">Reviewed
                                                      7 days ago</span>
                                                  </div>


                                                  <div class=
                                                       "review-text"
                                                       data-full-text=
                                                       "We just returned from a 4 night stay at zemi beach. Overall the hotel is luxurious and well appointed. Our room had beautiful views of shoal beach, although one building still had rebar and was still being constructed. We noticed the hotel was 15% occupied felt a little quite and empty. &lt;br/&gt;pros: Nice rooms, great views, beautiful main pool with day beds, not crowded if you like to be alone, quite, beautiful grounds and landscaping. great service by the pool and beach. &lt;br/&gt;cons: only one pool that is really functional which is by the beach, the other pool is in the upper level, cold water, shaded most of the day and no real view.&lt;br/&gt;restaurants are empty ate dinner first night at stone, extremely overpriced compared to other restaurants on the island. food average. the service: enough people serving you but you really did not know who our waiter was, it seemed disorganized. We had the bimbimbap as one of our dishes which was $50 for an entrée and there was a 1/2 cup of oil in the bottom of the dish. Our most expensive dinner on the island and average tasting. We went out rest of the nights to jacala, veya, , viceroy, all meals where less expensive and better. Breakfast buffet was courtyard Marriott scale at best $64 for 2 people, not many choices. Attempt at good service but even getting an omelet or coffee took time. &lt;br/&gt;Shoal beach has beautiful soft sand, but water tends to be wavy and sometimes to dangerous to swim. When getting in the water it drops to 5-6 feet right away. We enjoyed walking down to the beach bars down the beach of which we thought madeariman beach bar was great. Try the escargot app, pizza with lobster.. &lt;br/&gt;Shoal beach is far from the main part of the island. meads bay is where all the nightlife and restaurants are. Every night we had to trek 25-30 min across the island to go out for dinner . So I highly recommend renting a car , as taxis would cost you a pretty penny. The spa is nice, no real hot tub near the pools. the only one is at the spa, which is heated to body temp plunge pool, but they make you pay to use it. Which we found odd since no one was there and there are no hot tub options by any of the pools&lt;br/&gt;I see the vision of the builder, possibly build it on shoal beach and they will come. the resort is well done and beautiful. there are no restaurant options near bye, it's off the beaten path. If your looking just to stay put and have limited dining options then this resort will deliver on it's boutique elements. I hope it gets busier, but if your looking for more accessibility, restaurants, calmer waters etc.. I would stick to the other side of the island. I wish them luck">
                                                      We just returned from a
                                                      4 night stay at zemi
                                                      beach. Overall the
                                                      hotel is luxurious and
                                                      well appointed. Our
                                                      room had beautiful
                                                      views of shoal beach,
                                                      although one building
                                                      still had rebar and was
                                                      still being
                                                      constructed. We noticed
                                                      the hotel …
                                                      <a class="show-full-review"
                                                         href="#">more</a>
                                                  </div>
                                              </div>


                                              <div class="ta-review odd">
                                                  <div class=
                                                       "review-title">
                                                      <h2>“Lunch at 20
                                                          Knots = Fab!”</h2>
                                                  </div>


                                                  <div class="clearfix">
                                                      <div class=
                                                           "ta-rating">
                                                          <span class=
                                                                "icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span>
                                                      </div>
                                                      <span class=
                                                            "review-publish-date">Reviewed
                                                      7 days ago</span>
                                                  </div>


                                                  <div class=
                                                       "review-text"
                                                       data-full-text=
                                                       "The last time we had been in Anguilla, Zemi was not yet opened, so my husband and I were anxious to check out the property. Our experience was wonderful right from the cheerful security guard who greeted us at the gate, to the fact they served my favourite rose by the glass!&lt;br/&gt;The grounds are spectacular, and the staff member escorting us by golf cart to the lunch venue pointed out the spa, gym, and lap pool to us as we went by. Construction is not 100% complete for the rooms, but the vast majority is, and certainly anyone could have a lovely stay there at this point. &lt;br/&gt;The beach pool is well-laid out, with what looks like areas for bottle service, a great beach bar area, and some outdoor dining for 20 Knots, the casual dining eatery in the resort.&lt;br/&gt;4 of us ate, with 3 of us having pizza and one having tacos. We all loved our lunches. Our server was very attentive, friendly and funny.&lt;br/&gt;The only small disappointment was when we asked to be shown a room. My parents were enchanted with Zemi, and had declared they may return for their upcoming 50th anniversary. We were told this wasn't possible, which was surprising since it was obvious the resort was in no way full.&lt;br/&gt;Regardless, the lunch was spectacular and we had a great time.">
                                                      The last time we had
                                                      been in Anguilla, Zemi
                                                      was not yet opened, so
                                                      my husband and I were
                                                      anxious to check out
                                                      the property. Our
                                                      experience was
                                                      wonderful right from
                                                      the cheerful security
                                                      guard who greeted us at
                                                      the gate, to the fact
                                                      they se … <a class=
                                                                   "show-full-review"
                                                                   href="#">more</a>
                                                  </div>
                                              </div>


                                              <div class=
                                                   "ta-review even">
                                                  <div class=
                                                       "review-title">
                                                      <h2>“Gorgeous beach
                                                          and hotel”</h2>
                                                  </div>


                                                  <div class="clearfix">
                                                      <div class=
                                                           "ta-rating">
                                                          <span class=
                                                                "icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span>
                                                      </div>
                                                      <span class=
                                                            "review-publish-date">Reviewed
                                                      21 days ago</span>
                                                  </div>


                                                  <div class=
                                                       "review-text"
                                                       data-full-text=
                                                       "My husband and I are frequent travelers to the smaller, less crowded, prettier islands. Anguilla did not disappoint, it was amazing! Zemi is located on a gorgeous beach, perfect for long walks. The water is the loveliest blue/turqoise and the seas are perfect for swimming and snorkeling. The resort itself is truly a 5 star. Rooms are superb, with plenty of space. View from balcony everything we hoped for, the landscaping outstanding, 2 pools- one adjacent to the beach has comfortable beds, lounge chairs, sun or shade (palm trees and umbrella)..view of Shoal Bay to die for. Thank you to all of the staff--- couldn't have been more attentive w/out being intrusive. Breakfast and lunch excellent. One restaurant Stone had not opened yet but 20 Knots was great. We will return!">
                                                      My husband and I are
                                                      frequent travelers to
                                                      the smaller, less
                                                      crowded, prettier
                                                      islands. Anguilla did
                                                      not disappoint, it was
                                                      amazing! Zemi is
                                                      located on a gorgeous
                                                      beach, perfect for long
                                                      walks. The water is the
                                                      loveliest blue/turqoise
                                                      and t … <a class=
                                                                 "show-full-review"
                                                                 href="#">more</a>
                                                  </div>
                                              </div>


                                              <div class="ta-review odd">
                                                  <div class=
                                                       "review-title">
                                                      <h2>“The next great
                                                          Carribbean Resort
                                                          experience”</h2>
                                                  </div>


                                                  <div class="clearfix">
                                                      <div class=
                                                           "ta-rating">
                                                          <span class=
                                                                "icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span><span class="icon-full"></span>
                                                      </div>
                                                      <span class=
                                                            "review-publish-date">Reviewed
                                                      25 days ago</span>
                                                  </div>


                                                  <div class=
                                                       "review-text"
                                                       data-full-text=
                                                       "We have been traveling to the &amp;quot;islands&amp;quot; for over 25 years, from the Bahamas to the USVI/BVI and the BWI. Always looking for a high quality, luxury experience, that is away from a corporate hotel/resort feel. We love to find smaller properties that offer an authentic Caribbean experience but with the comfort of home. If you have traveled to the St John, Virgin Gorda, St Lucia, Peter Island etc., and looking for something less crowded, less over done, and more authentic, but five star, you should make Zemi your next spot.&lt;br/&gt;&lt;br/&gt;Zemi Beach House has everything we look for: located on Shoal Bay (one of the worlds highest rated beaches with precious little development), the property is passionate about luxury and compatibility with the Island. The room and suites are British West with the best finishes, furniture and fixtures we have seen in the Caribbean. The amenities including many infinity pools and spa are comparable to any luxury hotel. The landscape is amazing and should win awards alone. What is great is that its a new property with all state of the art comfort and clearly the owners are passionate about this project as the staff is among the nicest and thoughtful we have experienced in our island travels.&lt;br/&gt;&lt;br/&gt;I can tell we had little reason to wonder off property as the outdoor dinning, pool bar and beach services really make you want to stay right there. At night, the linen service dining was as formal as we need on our island trips.&lt;br/&gt;&lt;br/&gt;Lastly, I would say the guest crowd are a great balance of people looking for their island time and the property never felt crowded. &lt;br/&gt;&lt;br/&gt;I'd make my next down island trip to Zemi and discover it before everyone else is reading about what Zemi as the next new great destination.">
                                                      We have been traveling
                                                      to the "islands" for
                                                      over 25 years, from the
                                                      Bahamas to the USVI/BVI
                                                      and the BWI. Always
                                                      looking for a high
                                                      quality, luxury
                                                      experience, that is
                                                      away from a corporate
                                                      hotel/resort feel. We
                                                      love to find small …
                                                      <a class=
                                                         "show-full-review"
                                                         href="#">more</a>
                                                  </div>
                                              </div>
                                              <a class="read-all-reviews"
                                                 href=
                                                 "https://www.tripadvisor.com/Hotel_Review-g7092973-d8865337-Reviews-Zemi_Beach_House_Resort_Spa-Shoal_Bay_Village_Anguilla.html"
                                                 target="_blank">Read All
                                                  Reviews</a>
                                          </div>
                                      </section>
                                      <!-- End Comments -->
                                  </div>
                                  <div aria-labelledby="gallery-tab"
                                       class="tab-pane fade" id="gallery"
                                       role="tabpanel" style=
                                       "padding:40px;border-left: 1px solid #ddd; height: auto;border-right: 1px solid #ddd;border-left: 1px solid #ddd;border-bottom: 1px solid #ddd;">
                                      <!--  Comments -->


                                      <section class="comments clearfix">
                                          <div class="row">
                                            <?php foreach ($galleryImg as $key => $value): ?>
                                              <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                                <a class="thumbnail"href="#"><img alt=""class="img-responsive"src="<?php echo DOCBASE."medias/hotel/big/".$value['fileId']."/".$value['fileName']?>"></a>
                                              </div>
                                            <?php endforeach; ?>
                                          </div>
                                      </section>
                                      <!-- End Comments -->
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-3 hidden-xs hidden-sm">
                          <div class="row" style="padding-top:0;">
                              <div class="box reviews-summary-box mr-bottom-0">
                                  <div class="cols-nested" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">

                                      <h4 class="text-center title-wrapper-border red">Staycation Reviews</h4>
                                      <div id="<?php echo $hotel_id; ?>" data-idhotel="<?php echo $hotel_id;?>" data-iduser="<?php echo $_SESSION['user']['id'];?>" class=" row">
                                          <div value="<?php echo $like['likes']; ?>" class="row">
                                              <span class="ti-heart id" style="font-size: 35px;color: #d03238;margin-right:20px;float: left;"></span>
                                              <span class="recommendation-text"></span>
                                              <h3 style="margin-top: 0px;font-size: 40px;">
                                                  <?php if ($likes >= 1) {?>
                                                      <span class="recommendation-text"><?php echo $likes; ?></span>
                                                  <?php } else { ?>
                                                      <span class="recommendation-text">0</span>
                                                  <?php } ?>
                                              </h3>
                                          </div>
                                          <div class="row">
                                              <span class="ti-heart-broken" style="font-size: 35px;color: #00a0ae;margin-right:20px;float: left;"></span>
                                              <span class="recommendation-text"></span>
                                              <h3 style="margin-top: 0;font-size: 40px;">
                                                  <?php if ($likes >= 1) {?>
                                                      <span class="recommendation-text"><?php echo $dislike; ?></span>
                                                  <?php } else { ?>
                                                      <span class="recommendation-text">0</span>
                                                  <?php } ?>
                                              </h3>
                                          </div>
                                      </div>
                                  </div>
                              </div>


                              <div class="box reviews-summary-box">
                                  <div class="" id=
                                  "trip-advisor-summary">
                                      <div class="TA_selfserveprop" id=
                                      "TA_selfserveprop776">
                                          <ul class="TA_links sbQbPH4in"
                                              id="WNLf580tC8e5" style=
                                          " padding-left: 10%;">
                                              <li class="7rKNErTbJu" id=
                                              "xBSVAi8z" style=
                                                  " list-style: none;">
                                                  <a href=
                                                     "https://www.tripadvisor.com/"
                                                     target=
                                                     "_blank"><img alt=
                                                                   "TripAdvisor" src=
                                                                   "https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png"><br>Here
                                                      goes the trip advisor
                                                      ratings</a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="widget">
                              <h6 class="title"><img src="images/icons/amenities/florida-resident.png" />Florida Residents Only </h6>


                              <p>Staycation rates and perks are for Florida residents only. Proof of residency will be required at check in. </p>
                          </div>
                          <div class="widget">
                              <h6 class="title">Staycay Benefits </h6>
                              <ul class="staycation-benefits">
                                  <li>Lowest Florida resident rates.</li>
                                  <li>Best negotiated hotel perks.</li>
                                  <li>Collection of the finest hotels</li>
                              </ul>

                          </div>
                          <?php displayWidgets("nerby", $page_id); ?>
                      </div>
                  </div>
                  <!--Row End-->
              </div>
          </div>
      </div>
      <!-- Row End -->
  </div>


  <section class="boxes" id="contacts">
      <div class="container-fluid">
          <div class="row">
              <!-- Contacts -->


              <div class="col-md-4 bordered_block image_bck" data-color=
              "#f2f2f2" style=
              "height: 334px; background-color: rgb(242, 242, 242);">
                  <div class="col-md-12 simple_block text-left" style=
                  "height:auto; padding:81px 96px;">
                      <h3>Hotels By Area</h3>


                      <ul style=
                      "list-style:none;-webkit-padding-start:0">
                          <li>
                              <a href="#">Hotels in South Beach</a>
                          </li>


                          <li>
                              <a href="#">Hotels in Ft. Lauderdale</a>
                          </li>


                          <li>
                              <a href="#">Hotels in Key West</a>
                          </li>


                          <li>
                              <a href="#">Hotels in Brickell</a>
                          </li>
                      </ul>
                  </div>
              </div>


              <div class="col-md-4 bordered_block image_bck" data-color=
              "#f2f2f2" style=
              "height: 334px; background-color: rgb(242, 242, 242);">
                  <div class="col-md-12 simple_block text-left" style=
                  "height:auto; padding:81px 96px;">
                      <h3>Featured Hotels</h3>


                      <ul style=
                      "list-style:none;-webkit-padding-start:0">
                          <li>
                              <a href="#">Featured Hotels in South
                              Beach</a>
                          </li>


                          <li>
                              <a href="#">Featured Hotels in Ft.
                              Lauderdale</a>
                          </li>


                          <li>
                              <a href="#">Featured Hotels in Key West</a>
                          </li>


                          <li>
                              <a href="#">Featured Hotels in Brickell</a>
                          </li>
                      </ul>
                  </div>
              </div>


              <div class="col-md-4 bordered_block image_bck" data-color=
              "#f2f2f2" style=
              "height: 334px; background-color: rgb(242, 242, 242);">
                  <div class="col-md-12 simple_block text-left" style=
                  "height:auto; padding:81px 96px;">
                      <h3>Upcoming Events</h3>


                      <ul style=
                      "list-style:none;-webkit-padding-start:0">
                          <li>
                              <a href="#">Events in South Beach</a>
                          </li>


                          <li>
                              <a href="#">Events in Ft. Lauderdale</a>
                          </li>


                          <li>
                              <a href="#">Events in Key West</a>
                          </li>


                          <li>
                              <a href="#">Events in Brickell</a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          <!-- Row End -->
      </div>
  </section>
