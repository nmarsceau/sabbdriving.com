<?php

require_once 'common.php';
$class_dates = json_decode(file_get_contents('dates.json'), true);

require 'head.php';

?>

<body>
  <?php require 'nav.php'; ?>
  <?php require 'header.php'; ?>

  <div class="container">
    <div class="row">
      <h1 class="col-12 mb-4">Sabbadino Driving School</h1>
      <section class="col-lg-9"> <!-- main content -->
        <article>
          <h2>Learn Traffic Safety, Defensive Driving,<br />and Behind-the-Wheel Training</h2>
          <p>
            Welcome to Sabbadino Driving School where our priority is to make safety first and make safety last. Our driving courses, in Taylors, South Carolina,
            consist of sixteen hours of teaching time&mdash;ten hours in the classroom (split up over four class sessions) and six hours behind the wheel&mdash;for $330 (price subject to change).
            Students in Mr. Sabbadino&apos;s in-class driving course will learn the right attitude for drivers, defensive driving, the dangers of driving under the influence, nature&apos;s laws,
            railroad safety, truck safety, emergencies, and, as time allows, additional aspects of driving and traffic safety education. Classroom time is 6:00 pm to 8:30 pm once a week.
            The first session of behind-the-wheel driving will be scheduled during the first classroom time.
          </p>
          <p>
            Driving lessons behind the wheel (BTW) are designed to teach smooth starts and stops, increased speeds with controlled safety stops, front/rear vehicle judgement, and turning
            forward and backwards. BTW driver training includes off and on street driving lessons in Greenville and Paris Mountain. Driver training students drive an average of 122.7 miles
            in the course of the BTW driving classes. A student does not need to have a permit to drive with the instructor; however, a student does need a permit to drive with anyone else.
            A 15- or 16-year-old has to have a permit at least six months before taking a license test. All students need driving time with parents. By law, 15- and 16-year-old students have
            to have logged 40 hours of driving time with parents before getting a driver&apos;s license. For an additional fee of $50, Mr. Sabbadino is certified to administer the highway
            department driving test to anyone who has completed a Driver&apos;s Ed course. Once you have completed this test with Mr. Sabbadino, you can take your paperwork directly to the
            DMV to get your license. (<b>Note:</b> The DMV reserves the right to randomly select applicants for retesting.)
          </p>
          <p class="pb-0">
            Behind the Wheel Driving Lessons Include:
          </p>
          <ul>
            <li>Off-road forward and backing maneuvers</li>
            <li>Tracking (keeping the vehicle centered in the lane)</li>
            <li>Scanning (using eyes properly for defensive driving)</li>
            <li>Right and left turns</li>
            <li>Curb parking uphill and downhill</li>
            <li>Three-point turns</li>
            <li>Interstate driving (orientation, entering and exiting, lane changing, and passing)</li>
            <li>City driving (Downtown Greenville)</li>
            <li>Mountain driving (Paris Mountain)</li>
            <li>Parallel parking</li>
            <li>Practicing South Carolina Highway Department road tests</li>
            <li>For an extra fee, Certified 3rd party SCDMV road testing is available</li>
          </ul>
          <p>
            Contact <a href="mailto:jandjsabb@att.net?subject=websitequestions">Mr. Sabbadino</a> for more information or to register for the driving course.
          </p>
          <p>
            <a href="docs/CourseBenefits.pdf">Read what one of Mr. Sabbadino&apos;s students had to say</a> about the benefits of a driver&apos;s education course!
          </p>
        </article>
        <article class="mt-5">   
          <h2>Free DMV Permit Practice Tests</h2>
          <p>
            <a href="https://www.dmv-written-test.com/south-carolina/practice-test-1.html">DMV Written Test</a> and <a href="http://dmv-permit-test.com/">DMV Practice Test</a> offer several free practice permit tests.
            Taking sample DMV permit tests is a great way to prepare before taking the real written permit test!
          </p>
            
          <p>
            <a href="https://www.dmv-written-test.com/south-carolina/motorcycle/practice-test-1.html">DMV Written Test</a> also offers practice motorcycle permit tests.
          </p>
        </article>
      </section> <!-- end main content -->
      <section class="col-lg-3 mt-5 mt-lg-0"> <!-- sidebar -->
        <aside>
          <h2>Future Class Dates</h2>
          <?php foreach($class_dates as $class) {
            if (strtotime($class['expiration']) >= time()) {
              if ($class['full']) { ?>
                <p class="mb-2">
                  <span class="text-muted"><?php echo $class['name']; ?></span>
                  <span class="text-danger">Full!</span>
                </p>
              <?php } elseif (count($class['dates']) == 0) { ?>
                <p class="mb-2">
                  <span class="text-muted"><?php echo $class['name']; ?></span>
                  <span class="text-black-50">No Class</span>
                </p>
              <?php } else { ?>
                <a href="#<?php echo $class['id']; ?>" class="d-block mb-2 future-class-date" role="button" data-toggle="collapse"
                  aria-expanded="false" aria-controls="<?php echo $class['id']; ?>">
                  <strong><?php echo $class['name']; ?>&nbsp;</strong>
                </a>
                <div class="collapse mb-2" id="<?php echo $class['id']; ?>">
                  <?php foreach ($class['dates'] as $date) { ?>
                    <p class="pl-2 mb-0">
                      <?php echo date_format(date_create($date), 'F j, Y'); ?>
                    </p>
                  <?php } ?>
                </div>
              <?php }
            }
          } ?>
        </aside>

        <aside class="mt-5">
          <h2>Owner/Instructor</h2>
          <p>
            <strong>Joe Sabbadino</strong><br />
            Email: <a href="mailto:jandjsabb@att.net">jandjsabb@att.net</a><br />
            Phone: <a href="tel:18642920259">864.292.0259</a>
          </p>
        </aside>

        <aside class="mt-5">
          <h2>Class Location</h2>
          <p>
            <a href="https://maps.google.com/maps?oe=utf-8&client=firefox-a&q=525+taylors+rd+29687&ie=UTF8&hq=&hnear=525+Taylors+Rd,+Taylors,+South+Carolina+29687&gl=us&t=m&ll=34.911344,-82.297382&spn=0.033785,0.054932&z=14&iwloc=A&source=embed">
              Colonial Hills Baptist Church<br />
              525 Taylors Road<br />
              Taylors, SC 29687
            </a>
          </p>

          <p>
            As you face the front of the church, you will see a sidewalk on the right of the building with a sign that says "office."
            Follow that sidewalk to enter the lobby, and the classroom for our driving course is further in to the right.
            There will be a sign posted on the classroom door. Once you arrive at the church, you will see signs posted in various
            places to point you in the right direction.
          </p>
        </aside>
      </section> <!-- end sidebar -->
    </div>
  </div>

  <?php
    require 'footer.php';
    require 'scripts.php';
  ?>
  
</body>
</html>
