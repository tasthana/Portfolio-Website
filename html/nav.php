<!DOCTYPE html>
<nav>
    <a class= "<?php
    if ($pathParts['filename'] == "index"){
        print 'activePage';
}
    ?>" href="index.php">About Me</a>

    <a class= "<?php
    if ($pathParts['filename'] == "jobs"){
        print 'activePage';
}
    ?>" href="jobs.php">Jobs</a>

    <a class= "<?php
    if ($pathParts['filename'] == "project"){
        print 'activePage';
}
    ?>" href="project.php">Projects</a>

<a class= "<?php
    if ($pathParts['filename'] == "resume"){
        print 'activePage';
}
    ?>" href="resume.php">Resume</a>

<a class= "<?php
    if ($pathParts['filename'] == "extra"){
        print 'activePage';
}
    ?>" href="extra.php">Extracurriculars</a>

<a class= "<?php
    if ($pathParts['filename'] == "readme"){
        print 'activePage';
}
    ?>" href="readme.php">Read Me!</a>


</nav>