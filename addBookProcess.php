<?php

require "connection.php";

session_start();

$category = $_POST["category"];
$genre = $_POST["genre"];
$title = $_POST["title"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$publishedDate = $_POST["publishedDate"];
$isbn = $_POST["isbn"];
$language = $_POST["language"];
$qty = $_POST["qty"];
$pageCount = $_POST["pageCount"];
$price = $_POST["price"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["description"];
$overview = $_POST["overview"];

$dateTime = new DateTime();
$timeZone = new DateTimeZone("Asia/Colombo");
$dateTime->setTimezone($timeZone);
$date = $dateTime->format("Y-m-d H:i:s");

$status = 1;
$userEmail = $_SESSION["user"]["email"];

if (isset($_FILES["pdf"])) {
    $pdf = $_FILES["pdf"];
    $pdf_extention = $pdf["type"];
}
if (isset($_FILES["image"])) {
    $image = $_FILES["image"];
    $image_extention = $image["type"];
}

$allowed_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
$allowed_pdf_extention = array("application/pdf");

if ($category == "0") {
    echo "Please select a category.";
} else if ($genre == "0") {
    echo "Please select a genre.";
} else if (empty($title)) {
    echo "Please enter title to your book.";
} else if (empty($author)) {
    echo "Please enter your book's author.";
} else if (empty($publisher)) {
    echo "Please enter book publisher.";
} else if (empty($publishedDate)) {
    echo "Please enter book published date.";
} else if (empty($isbn)) {
    echo "Please enter isbn of your book.";
} else if ($language == "0") {
    echo "Please select a language.";
} else if (empty($qty)) {
    echo "Please enter quantity.";
} else if (empty($pageCount)) {
    echo "Please enter page count.";
} else if (empty($price)) {
    echo "Please enter price to your book.";
} else if (empty($dwc)) {
    echo "Please enter delivery charges to your book.";
} else if (empty($doc)) {
    echo "Please enter delivery charges to your book.";
} else if (empty($description)) {
    echo "Please enter description to your book.";
} else if (empty($overview)) {
    echo "Please enter overview to your book.";
} else if (!isset($_FILES["image"])) {
    echo "Please add cover image for your book.";
} else if (!isset($_FILES["pdf"])) {
    echo "Please add your book's PDF file.";
} else     if (!in_array($image_extention, $allowed_image_extention)) {
    echo "Please select a valid image.";
} else     if (!in_array($pdf_extention, $allowed_pdf_extention)) {
    echo "Please select a valid pdf.";
} else {
    $categoryHasGenre = Database::search("SELECT `id` FROM `category_has_genre` WHERE `category_id`= '" . $category . "' AND `genre_id` = '" . $genre . "'");

    if ($categoryHasGenre->num_rows == 0) {
        echo "This book does not exists";
    } else {
        $categoryHasGenreData = $categoryHasGenre->fetch_assoc();
        $categoryHasGenre = $categoryHasGenreData["id"];

        Database::iud("INSERT INTO `book` (`category_id`,`category_has_genre_id`,`title`,`overview`,`author`,`publisher`,`published_date`,`isbn`,`language`,`qty`,`page_count`,
            `description`,`price`,`status_id`,`user_email`,`date_time_added`,`delivery_fee_colombo`,`delivery_fee_other`) VALUES('" . $category . "','" . $categoryHasGenre . "','" . $title . "','" . $overview . "',
            '" . $author . "','" . $publisher . "','" . $publishedDate . "','" . $isbn . "','" . $language . "','" . $qty . "','" . $pageCount . "','" . $description . "','" . $price . "','" . $status . "',
            '" . $userEmail . "','" . $date . "','" . $dwc . "','" . $doc . "')");

        $last_id = Database::$connection->insert_id;
        $allowed_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
        $allowed_pdf_extention = array("application/pdf");

        // PDF File
        if (isset($pdf)) {
            $pdf_extention = $pdf["type"];

            if (!in_array($pdf_extention, $allowed_pdf_extention)) {
                echo "Please select a valid pdf.";
            } else {
                $new_pdf_extention;
                if ($pdf_extention == "application/pdf") {
                    $new_pdf_extention = ".pdf";
                }


                $pdf_name = "pdf//" . uniqid() . $new_pdf_extention;

                move_uploaded_file($pdf["tmp_name"], $pdf_name);

                Database::iud("INSERT INTO `pdf` (`code`,`book_id`) VALUES('" . $pdf_name . "','" . $last_id . "')");
            }
        } else {
            echo "Please select a valid pdf.";
        }


        // Cover Image
        if (isset($image)) {
            $image_extention = $image["type"];

            if (!in_array($image_extention, $allowed_image_extention)) {
                echo "Please select a valid image.";
            } else {
                $new_image_extention;
                if ($image_extention == "image/jpg") {
                    $new_image_extention = ".jpg";
                } else if ($image_extention == "image/jpeg") {
                    $new_image_extention = ".jpeg";
                } else if ($image_extention == "image/png") {
                    $new_image_extention = ".png";
                } else if ($image_extention == "image/svg") {
                    $new_image_extention = ".svg";
                }


                $image_name = "books//" . uniqid() . $new_image_extention;

                move_uploaded_file($image["tmp_name"], $image_name);

                Database::iud("INSERT INTO `images` (`code`,`book_id`) VALUES('" . $image_name . "','" . $last_id . "')");
            }
        } else {
            echo "Please select a valid image.";
        }
    }

    echo "success";
}
