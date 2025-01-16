<?php
class Courses {
    private $title;
    private $description;
    private $tags;
    private $category;
    private $content;

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
        return $this;
    }

    public function __get($property) {
        return property_exists($this, $property) ? $this->$property : null;
    }

    public function addContent(Content $content) {
        $this->content = $content;
    }

    public function showContents() {
        $this->content->createContent()->create();
    }
    public function showcourse() {
        echo $this->title.'<br>';
        echo $this->description.'<br>';
        echo $this->category.'<br>';
        $this->content->createContent()->create();
        echo '<br><br><br>';
    }
    public function insertCourse() {
        echo $this->title.'<br>';
        echo $this->description.'<br>';
        echo $this->category.'<br>';
        $this->content->createContent()->create();
        echo '<br><br><br>';
    }
}

interface Content {
    public function createContent();
}

class VideoContent implements Content {
    public function createContent() {
        return new Video();
    }
}

class DocumentContent implements Content {
    public function createContent() {
        return new Document();
    }
}

interface Make {
    public function create();
}

class Video implements Make {
    public function create() {
        echo "create video-based content<br>";
    }
}

class Document implements Make {
    public function create() {
        echo "create document-based content<br>";
    }
}

$videoContent = new VideoContent();
$documentContent = new DocumentContent();

$course = new Courses();
$course->title = "Learn PHP Design Patterns";
$course->description = "A comprehensive course on PHP design patterns.";
$course->category = "Programming";
$course->addContent($videoContent);
// $course->addContent($documentContent);


$course->showCourse();

?>