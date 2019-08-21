<?php

require_once 'common.php';
$class_dates = json_decode(file_get_contents('dates.json'), true);

require 'head.php';

?>

<body>
  <?php require 'nav.php'; ?>
  <?php require 'header.php'; ?>

  <div class="container">
    <div class="row pt-4">
      <h1 class="col-12 mb-4 visually-hidden">Sabbadino Driving School</h1>
      <section class="col-lg-9"> <!-- main content -->
        <article>
          <h2>Learn Traffic Safety, Defensive Driving,<br />and Behind-the-Wheel Training</h2>
          <p class="mt-4 mb-5">
            At Sabbadino Driving School, our mission is to make safety first and to make safety last. Our driving
            courses in Taylors, SC are taught by Joe Sabbadino. Mr. Sabb has over 50 years of experience teaching driver's
            education in the Greenville area. As a lifelong educator, he has a knack for helping his students understand
            the importance of defensive driving and traffic safety.
          </p>
          <h3 class="mt-5">Classroom Instruction</h3>
          <p class="mb-5">
            With 10 hours of classroom instruction, our driver training courses exceed the South Carolina driver
            education requirements. The classroom instruction is scheduled in two and a half hour sessions over four weeks.
          </p>
          <div class="my-5 mr-auto ml-auto text-center w-75">
            <img class="img-fluid" src="images/classroom instruction.jpg" alt="Mr. Sabbadino teaches a class" loading="lazy" />
          </div>
          <p class="mt-5">
            Classroom Instruction Covers:
          </p>
          <ul class="mb-5 two-columns">
            <li>Right attitudes for drivers</li>
            <li>Defensive driving</li>
            <li>Dangers of driving under the influence</li>
            <li>Nature's laws</li>
            <li>Railroad safety</li>
            <li>Truck safety</li>
            <li>Emergencies</li>
          </ul>

          <h3 class="mt-5 pt-5">Behind-the-Wheel Training</h3>
          <p class="mb-5">
            Our unique approach to behind-the-wheel training sets us apart. Mr. Sabbadino takes two students on
            each driving lesson. Each student drives for half of the lesson and observes for the other half.
            Mr. Sabb has found this technique to be highly effective. Our driving lessons are designed to teach smooth starts and stops, increased speeds with controlled safety stops,
            front/rear vehicle judgement, and turning forward and backwards.
          </p>
          <div class="my-5 mr-auto ml-auto text-center w-75">
            <img class="img-fluid" src="images/behind the wheel.jpg" alt="Mr. Sabbadino drives with a student" loading="lazy" />
          </div>
          <p class="mt-5">
            Behind-the-Wheel Driving Lessons Include:
          </p>
          <ul class="mb-5 two-columns">
            <li>Off-road forward and backing maneuvers</li>
            <li>Tracking (keeping the vehicle centered in the lane)</li>
            <li>Scanning (using eyes properly for defensive driving)</li>
            <li>Right and left turns</li>
            <li>Curb parking uphill and downhill</li>
            <li>Three-point turns</li>
            <li>Interstate driving</li>
            <li>City driving in Downtown Greenville</li>
            <li>Mountain driving at Paris Mountain</li>
            <li>Parallel parking</li>
            <li>Practicing South Carolina Highway Department road tests</li>
          </ul>
          <p class="my-5">
            In addition to the 6 hours of behind-the-wheel training, all students need driving time with parents.
            By law, 15- and 16-year-old students have to log 40 hours of driving time with parents before taking
            the license test.
          </p>
          <div class="my-5 did-you-know">
            <p class="mb-0 did-you-know-title">Did You Know?</p>
            <ul>
              <li>Students drive about 100 miles during their behind-the-wheel training</li>
              <li>A student does not need a permit to drive with a driving instructor. However, a student does need a
              permit to drive with anyone else</li>
            </ul>
          </div>

          <h3 class="mt-5 pt-5">Testing</h3>
          <p class="mb-5">
            For an additional fee, Mr. Sabbadino is also certified to give a license test to anyone who has
            completed a driver education course. <a href="#prices-block">See below for pricing</a>. Once you
            have completed this test with Mr. Sabbadino, you can take your paperwork directly to the DMV to
            get your license.<br>
            <em><strong>Note:</strong> The DMV reserves the right to randomly select applicants for retesting.</em>
          </p>
          <div class="my-5 did-you-know">
            <p class="mb-0 did-you-know-title">Did You Know?</p>
            <p class="">
              You need a driver's permit for at least 6 months before taking a license test
            </p>
          </div>

          <h3 id="prices-block" class="mt-5 pt-5">Prices</h3>
          <table class="table mb-5">
            <tbody>
              <tr>
                <td>Driver Education Course</td>
                <td><strong>$330</strong></td>
              </tr>
              <tr>
                <td>License Test</td>
                <td><strong>$50</strong></td>
              </tr>
            </tbody>
          </table>

          <p class="text-center my-5 pt-5" style="line-height: 3;">
            <a href="mailto:jandjsabb@att.net
            ?subject=Registration%20From%20Website
            &body=Hi,%20I'd%20like%20to%20register%20for%20one%20of%20your
            %20driver%20training%20classes."
            class="py-3 px-4 bg-sabbgreen text-white">Contact Mr. Sabbadino</a>
            <br> at <a href="mailto:jandjsabb@att.net
            ?subject=Registration%20From%20Website
            &body=Hi,%20I'd%20like%20to%20register%20for%20one%20of%20your
            %20driver%20training%20classes.">jandjsabb@att.net</a> to register for a course.
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

        <aside class="mt-5">
          <h2>Benefits of Driver Education</h2>
          <p>
            Read what one of Mr. Sabbadino&apos;s students had to say about
            <a href="docs/CourseBenefits.pdf">the benefits of a driver&apos;s education course!</a>
          </p>
        </aside>

        <aside class="mt-5">   
          <h2>Free DMV Permit Practice Tests</h2>
          <p>
            <a href="https://www.dmv-written-test.com/south-carolina/practice-test-1.html">DMV Written Test</a> and <a href="http://dmv-permit-test.com/">DMV Practice Test</a> offer several free practice permit tests.
            Taking sample DMV permit tests is a great way to prepare before taking the real written permit test!
          </p>
            
          <p>
            <a href="https://www.dmv-written-test.com/south-carolina/motorcycle/practice-test-1.html">DMV Written Test</a> also offers practice motorcycle permit tests.
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
