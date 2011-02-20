<?php
require 'bootstrap.php';

/**
 * The following code demonstrates writing a event object that will act as
 * a classroom starting its day, keeping track of the students that have
 * arrived to class and giving them a welcome message based on the time students
 * arrive to class.
 *
 * The event object is no different than any ordinary PHP object you
 * are accustomed to writing, all you need to do is extend the prggmr\Event
 * class.
 */

class Student_Tracker extends prggmr\Event {
    
    const CLASS_FULL = 200;
    
    /**
     * The students that have arrived in class.
     *
     * @var  array
     */
    public $_arrivals = array();
    
    /**
     * The students roster.
     *
     * @var  array
     */
    public $_students = array();
    
    /**
     * Responses given when a student arrives.
     *
     * @var  array
     */
    public $_responses = array(
        'early'  =>  '%s your early, Welcome to class!', 
        'ontime' =>  'Hello %s! right on time for class!', 
        'late'   =>  'Well hello %s nice of you to show!',
        'tardy'  =>  'A tardy notice has been sent to %s!'
    );
}

// Create a subscription to the student_arrive event
\prggmr::listen('student_arrived', function($event, $student, $time){
    $arrivee = $event->_students[$student];
    $event->_arrivals[] = array(
        $arrivee,
        $time
    );
    if ($time <= 0) {
        echo sprintf($event->_responses['early'], $arrivee)."<br />";
    } elseif ($time <= 59) {
        echo sprintf($event->_responses['ontime'], $arrivee)."<br />";
    } else {
        echo sprintf($event->_responses['late'], $arrivee)."<br />";
    }
    unset($event->_students[$student]);
});

// Create another subscription for when all students arrive to class
\prggmr::listen('all_students_arrived', function($event){
    // Set the event to indicate all students are now in class
    $event->setState(Student_Tracker::CLASS_FULL);
    echo 'Hello Everyone, Lets begin class!'; 
});

// Create a subscription when the classroom will no longer allow students.
\prggmr::listen('classroom_closed', function($event){
    // We have tardy students .... uh oh
    // We also rely on the state of the event rather than the count
    // of students that still exist on the roster.
    if (Student_Tracker::CLASS_FULL !== $event->getState()) {
        foreach ($event->_students as $_key => $_student) {
            echo sprintf($event->_responses['tardy'], $_student)."<br />";   
        }
    }

});

// Init our event object
$student_tracker = new Student_Tracker();

// Create a range of students to loop
$students = range(1, 20);
$count = -10;

// Set our roster
$student_tracker->_students = $students;

// Create a loop that will run 80 times
// 10 count for students coming in early
// 60 count for students on time
// 10 count fot students late
while ($count != 70) {
    $rand = rand(0, 1000);
    
    if ($rand >= 750) {
        $student = array_rand($students, 1);
        // Publish this student arrived to class
        $student_tracker->student_arrived(array(
            $student,
            $count
        ));
        unset($students[$student]);
        if (count($students) == 0) {
            // Publish that all students have arrived to class!
            $student_tracker->all_students_arrived();
            break;
        }
    }
    $count++;
    // Sleep and print results
}

// Publish the classroom has closed
$student_tracker->classroom_closed();