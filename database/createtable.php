<?php
$path = $_SERVER['DOCUMENT_ROOT'];
require_once $path."/ASTRA/database/database.php";
function cleartable($dbo, $tabName)
{
    $c = "delete from:tabName";
    $s = $dbo -> conn -> prepare($c);
    try
    {
        $s -> execute([":tabName" => $tabName]);
    }
    catch (PDOException $oo)
    {

    }
}
$dbo= new Database();

$c= "create table student_details 
(
    id int auto_increment primary key,
    roll_no varchar(20) unique,
    name varchar(50)
)";
$s= $dbo -> conn -> prepare($c);
try {
    $s -> execute();
    echo ("<br> student_details created");
}
catch (PDOException $o) 
{
    echo ("<br> student_details not created");
}

$c= "create table course_details 
(
    id int auto_increment primary key,
    code varchar(20) unique,
    title varchar(50),
    credit int
)";
$s= $dbo -> conn -> prepare($c);
try {
    $s -> execute();
    echo ("<br> course_details created");
}
catch (PDOException $o) 
{
    echo ("<br> course_details not created");
}

$c= "create table faculty_details 
(
    id int auto_increment primary key,
    user_name varchar(20) unique,
    name varchar(100),
    password varchar(50)
)";
$s= $dbo -> conn -> prepare($c);
try {
    $s -> execute();
    echo ("<br> faculty_details created");
}
catch (PDOException $o) 
{
    echo ("<br> faculty_details not created");
}

$c= "create table session_details 
(
    id int auto_increment primary key,
    year int,
    term varchar(50),
    unique (year,term)
)";
$s= $dbo -> conn -> prepare($c);
try {
    $s -> execute();
    echo ("<br> session_details  created");
}
catch (PDOException $o) 
{
    echo ("<br> session_details  not created");
}

$c= "create table course_registration
(
    student_id int,
    course_id int,
    session_id int,
    primary key (student_id,course_id,session_id)
)";
$s= $dbo -> conn -> prepare($c);
try {
    $s -> execute();
    echo ("<br> course_registration created");
}
catch (PDOException $o) 
{
    echo ("<br> course_registration not created");
}

$c= "create table course_allotment
(
    faculty_id int,
    course_id int,
    session_id int,
    primary key (faculty_id,course_id,session_id)
)";
$s= $dbo -> conn -> prepare($c);
try {
    $s -> execute();
    echo ("<br> course_allotment created");
}
catch (PDOException $o) 
{
    echo ("<br> course_allotment not created");
}

$c= "create table attendance_details
(
    faculty_id int,
    course_id int,
    session_id int,
    student_id int,
    on_date date,
    status varchar(10),
    primary key (faculty_id,course_id,session_id,student_id,on_date)
)";
$s= $dbo -> conn -> prepare($c);
try {
    $s -> execute();
    echo ("<br> attendance_details created");
}
catch (PDOException $o) 
{
    echo ("<br> attendance_details not created");
}

$c = "INSERT INTO student_details (id, roll_no, name) VALUES
(1, '2023-09123', 'Mark Jaily Pena'),
(2, '2023-01127', 'Carl Raymund Suello'),
(3, '2023-19153', 'Rommel Rutherford Yong'),
(4, '2023-41639', 'Lance Andrei Recla'),
(5,'2023-89823', 'Mark Jaily Pena'),
(6, '2023-21223', 'Reigh Sean Veras'),
(7, '2023-01520', 'Errol James Minguez'),
(8, '2023-18121', 'Yldevier John Magpusao'),
(9, '2023-69323', 'Maxwell Gazo'),
(10, '2023-99113', 'Gabriel Duhaylungsod'),
(11, '2023-09233', 'Justine Veloso'),
(12, '2023-81423', 'Aaron Gamad'),
(13, '2023-00223', 'John Andrei Manalo'),
(14, '2023-99183', 'Deniel Dave Natividad'),
(15, '2023-11029', 'Dave Laurence Dagohoy')";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo "<br> student_details inserted";
} catch (PDOException $o) {
    echo "<br> student_details not inserted: " . $o->getMessage();
}

$c = "INSERT INTO faculty_details (id, user_name, password, name) VALUES
(1, 'vbcalag', '12345', 'Vicente Calag'),
(2, 'jmcatane', '12345', 'Jose Ricardo Catane'),
(3, 'amsatina', '12345', 'Armacheska Satina'),
(4, 'hllimpag', '12345', 'Hannah Mae Limpag')";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo "<br> faculty_details inserted";
} catch (PDOException $o) {
    echo "<br> faculty_details not inserted: " . $o->getMessage();
}

$c = "INSERT INTO session_details (id, year, term) VALUES
(1, 2023, 'FIRST SEMESTER'),
(2, 2024, 'SECOND SEMESTER')";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo "<br> session_details inserted";
} catch (PDOException $o) {
    echo "<br> session_details not inserted: " . $o->getMessage();
}

$c = "INSERT INTO course_details (id, code, title, credit) VALUES
(1, 'CMSC126', 'Web-based System Development', 3),
(2, 'STAT1', 'Elementary Statistics', 3),
(3, 'CMSC18', 'Computer Programming I', 3),
(4, 'CMSC56', 'Discrete Mathematical Structures in Computer Science I', 3),
(5, 'CMSC57', 'Discrete Mathematical Structures in Computer Science II', 3),
(6, 'CMSC28', 'Computer Programming II', 3),
(7, 'MATH26', 'Analytic Geometry and Calculus I', 3),
(8, 'CMSC130', 'Logic Design and Digital Computer Circuits', 3)";
$s = $dbo->conn->prepare($c);
try {
    $s->execute();
    echo "<br> course_details inserted";
} catch (PDOException $o) {
    echo "<br> course_details not inserted: " . $o->getMessage();
}


// Clear the course_registration table if there is a record already
cleartable($dbo, "course_registration");

$c = "INSERT INTO course_registration
(student_id, course_id, session_id)
VALUES
(:sid, :cid, :sessid)";
$s = $dbo->conn->prepare($c);

// Iterate over 15 students
// For each student choose up to 3 random courses from 1 to 8
for ($i = 1; $i <= 15; $i++) {
    for ($j = 0; $j < 3; $j++) {
        // First semester
        $cid = rand(1, 8);
        try {
            $s->execute([":sid" => $i, ":cid" => $cid, ":sessid" => 1]);
        } catch (PDOException $pe) {
            // Handle exception or log error if necessary
        }

        // Second semester
        $cid = rand(1, 8);
        try {
            $s->execute([":sid" => $i, ":cid" => $cid, ":sessid" => 2]);
        } catch (PDOException $pe) {
            // Handle exception or log error if necessary
        }
    }
}

// Clear the course_allotment table if there is a record already
cleartable($dbo, "course_allotment");

$c = "INSERT INTO course_allotment
(faculty_id, course_id, session_id)
VALUES
(:fid, :cid, :sessid)";
$s = $dbo->conn->prepare($c);

// Iterate over all 4 teachers
// For each teacher choose up to 2 random courses from 1 to 8
for ($i = 1; $i <= 4; $i++) {
    for ($j = 0; $j < 2; $j++) {
        // First semester
        $cid = rand(1, 8);
        try {
            $s->execute([":fid" => $i, ":cid" => $cid, ":sessid" => 1]);
        } catch (PDOException $pe) {
            // Handle exception or log error if necessary
        }

        // Second semester
        $cid = rand(1, 8);
        try {
            $s->execute([":fid" => $i, ":cid" => $cid, ":sessid" => 2]);
        } catch (PDOException $pe) {
            // Handle exception or log error if necessary
        }
    }
}


?>