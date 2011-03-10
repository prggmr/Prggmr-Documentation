<h2>
    The Student Tracker - <span class="green">Beginner</span>
</h2>
<p>
    The code below represents a student tracking object which records the time a student arrives to class,
    sends them a welcome message based on the time they arrive and dispatches a tardy notice to any student that
    fails to arrive within the allowed time, analyze the code, run the example and have fun!
</p>
<pre class="prettyprint linenums">
/**
 * Student Tracker Object
 *
 * The student tracker extends the prggmr\Event object
 * which is the main class for creating event objects
 * in prggmr.
 *
 */
class Student_Tracker extends prggmr\Event {

    /**
     * Event state set when the classroom is full.
     * Event states are used throughout an events cycle and
     * are represented as integers.
     *
     * @var  integer
     */
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

/**
 * Create a subscription to the student_arrive event using the global
 * prggmr::listen method.
 *
 * This action will be bubbled everytime a student arrives to class, allowing
 * us to track that information.
 *
 * The first parameter 'student_arrive' is the event in which we will listen for
 * the second parameter is the \Closure object which will be triggered when
 * this event is bubbled.
 *
 * We pass in 3 parameters to the Closure.
 *
 * $event The \prggmr\Event object which is the event object bubbling this action,
 * in this case it will be a reference to the above Student_Tracker event object.

 * $student a string of student id arriving to class.

 * $time an integer containing the time the student arrived.
 */
\prggmr::listen('student_arrived', function($event, $student, $time){
    // Pull this student
    $arrivee = $event->_students[$student];
    // Add the student to our arrivals list
    $event->_arrivals[] = array(
        $arrivee,
        $time
    );
    // Based on the time they arrive spit out our message to them
    if ($time <= 0) {
        echo sprintf($event->_responses['early'], $arrivee)."";
    } elseif ($time <= 59) {
        echo sprintf($event->_responses['ontime'], $arrivee)."";
    } else {
        echo sprintf($event->_responses['late'], $arrivee)."";
    }
    // finally remove this student from the expected roster
    unset($event->_students[$student]);
});

/**
 * Create another subscription to the all_student_arrived, that will
 * allow us to set the events state.
 *
 * Working exactly as the 'student_arrive' action, we pass
 * the event string in which we are listening for, and the \Closure object
 * that will be executed when this event is bubbled.
 *
 * In this action we only need to accept the '$event' parameter which again
 * will be a reference to the Student_Tracker event object.
 */
\prggmr::listen('all_students_arrived', function($event){
    /**
     * Set the event state using `prggmr\Event::setState()` method which accepts
     * two parameters.
     *
     * The first being the state to set the event, and the second an optional message
     * to associate with this state.
     */
    $event->setState(Student_Tracker::CLASS_FULL);
    // Dump our final message
    echo 'Hello Everyone, Lets begin class!';
});

/**
 * Finally we will create another subscription to the classroom_closed, which
 * will allow us to send a tardy notice to any students still existing on the
 * expected students roster.
 */
\prggmr::listen('classroom_closed', function($event){
    /**
     * For this action we will only need to check the state of the event
     * using `prggmr\Event::getState()` method which returns the current state
     * the event is in.
     *
     * We will use the event state rather than counting the students roster to
     * prevent any students being sent a tardy notice when the classroom is full
     * and they were not removed from the expected students roster ( for any reason ).
     */
    if (Student_Tracker::CLASS_FULL !== $event->getState()) {
        foreach ($event->_students as $_key => $_student) {
            echo sprintf($event->_responses['tardy'], $_student)."";
        }
    }

});

/**
 * Here we will run the actual code to generate our events.
 *
 * First we will setup our Student_Tracker event object.
 */
$student_tracker = new Student_Tracker();

// Next we will create a fake roster of students using `range`.
$students = range(1, 20);
$count = -10;

// Set our roster in the event object.
$student_tracker->_students = $students;

// Create a loop that will run 80 times
// 10 count for students coming in early
// 60 count for students on time
// 10 count oft students late
while ($count != 70) {

    $rand = rand(0, 1000);
    // Simple randomizer so we dont get all students arriving on every loop...
    if ($rand >= 750) {

        // Randomly select a student from the roster
        $student = array_rand($students, 1);

        /**
         * Publish that the student has arrived
         *
         * We will publish this event by overloading the call into the Student_Tracker
         * event object, using the method as the event name, with the second parameter
         * an array of variables to pass to the subscribing action, you will also
         * notice that in our above subscription call we have 3 parameters but only pass in
         * two below, this is because each bubbled action is automatically passed the
         * event object as the first parameter.
         */
        $student_tracker->student_arrived(array(
            $student,
            $count
        ));

        // remove from the expected roster
        unset($students[$student]);

        // If nomore students are expected publish the `all_students_arrive` event.
        if (count($students) == 0) {
            // Publish that all students have arrived to class!
            $student_tracker->all_students_arrived();
            break;
        }
    }
    $count++;
}

// Publish the classroom has closed
$student_tracker->classroom_closed();
</pre>
<p>
    <a href="#" onclick="loadExample('Student Tracker Tutorial', 'examples/student_tracker.php'); return false;">Run this example!</a>
</p>