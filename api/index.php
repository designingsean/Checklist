<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
date_default_timezone_set('America/New_York');
require_once 'meekrodb.2.1.class.php';
require_once 'db.config.php';
DB::$param_char = '%%';

$action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];

switch ($action) {
    //users
    case 'usersGet' :
        $results = DB::query('SELECT id, name, active FROM users');
    break;

    //tasks
    case 'tasksAdd' :
        //-add = adds a new task
        //---pass in task name (required), day parts, and days of week
        //---return success/fail
        if (isset($_POST['task']) {
            $columns = array();
            $columns['task'] = isset($_POST['task']) ? $_POST['task'] : NULL;
            $columns['mon'] = isset($_POST['mon']) ? $_POST['mon'] : false;
            $columns['tue'] = isset($_POST['tue']) ? $_POST['tue'] : false;
            $columns['wed'] = isset($_POST['wed']) ? $_POST['wed'] : false;
            $columns['thu'] = isset($_POST['thu']) ? $_POST['thu'] : false;
            $columns['fri'] = isset($_POST['fri']) ? $_POST['fri'] : false;
            $columns['sat'] = isset($_POST['sat']) ? $_POST['sat'] : false;
            $columns['sun'] = isset($_POST['sun']) ? $_POST['sun'] : false;
            $columns['open'] = isset($_POST['open']) ? $_POST['open'] : false;
            $columns['midday'] = isset($_POST['midday']) ? $_POST['midday'] : false;
            $columns['close'] = isset($_POST['close']) ? $_POST['close'] : false;
            $results = DB::insert('tasks', $columns);
        }
    break;

    case 'tasksGet' :
        //-get = get list of tasks
        //---pass in completed (required)
        //---return *
        if (isset($_GET['completed'])) {
            $results = DB::query('SELECT id, name, phone, message, DATE_FORMAT(received, "%Y%m%dT%H%i%s") as received, completed FROM calls WHERE completed=%%s ORDER BY received ASC', $_GET['completed']);
        }
    break;

    case 'tasksUpdate' :
        // update = change completed status
        // pass in id (required)
        // return success/fail
        if (isset($_GET['id'])) {
            $results = DB::update('calls', array('completed' => DB::sqleval("NOT completed")), 'id=%%s', $_GET['id']);
        }
    break;

    //checklist
    case 'checklistAdd' :
        //-add = add note
        //---pass in call id, user id, comments (all required)
        //---return success/fail
        if ((isset($_POST['callID'])) && (isset($_POST['userID'])) && (isset($_POST['comments']))) {
            $columns = array();
            $columns['callID'] = $_POST['callID'];
            $columns['userID'] = $_POST['userID'];
            $columns['notesDate'] = date('Y-m-d H:i:s');
            $columns['comments'] = $_POST['comments'];
            $results = DB::insert('notes', $columns);
        }
    break;

    case 'checklistGet' :
        //-get = get all notes for a particular call
        //---pass in call id (required)
        //---return *
        if (isset($_GET['call'])) {
            $results = DB::query('SELECT id, callID, userID, DATE_FORMAT(notesDate, "%Y%m%dT%H%i%s") as notesDate, comments FROM notes WHERE callID=%%s ORDER BY notesDate DESC', $_GET['call']);
        }
    break;
}

//return query results as JSON
echo json_encode($results);