<?php

session_start();

require "connection.php";

$title = $_POST["title"];
$author = $_POST["author"];
$publisher = $_POST["publisher"];
$publishedDate = $_POST["publishedDate"];
$isbn = $_POST["isbn"];
// $language = $_POST["language"];
$qty = $_POST["qty"];
$pageCount = $_POST["pageCount"];
$price = $_POST["price"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$description = $_POST["description"];
$overview = $_POST["overview"];
if (isset($_POST["image"])) {
    $image = $_POST["image"];
}
if (isset($_POST["pdf"])) {
    $pdf = $_POST["pdf"];
}

$bookId = $_SESSION["userBooks"]["id"];

if (empty($title)) {
    echo "Please enter title to your book.";
} else if (empty($author)) {
    echo "Please enter your book's author.";
} else if (empty($publisher)) {
    echo "Please enter book publisher.";
} else if (empty($publishedDate)) {
    echo "Please enter book published date.";
} else if (empty($isbn)) {
    echo "Please enter isbn of your book.";
} 
// else if ($language == "0") {
//     echo "Please select a language.";
// }
 else if (empty($qty)) {
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
}
// else if (!isset($_FILES["image"])) {
//     echo "Please add cover image for your book.";
// } 
// else if (!isset($_FILES["pdf"])) {
//     echo "Please add your book's PDF file.";
// } 
else {
    // PDF File
    $allowed_image_extention = array("image/jpg", "image/jpeg", "image/png", "image/svg");
    $allowed_pdf_extention = array("application/pdf");

    if (isset($_POST["pdf"])) {
    } else {
        if (isset($_FILES["pdf"])) {
            $pdf = $_FILES["pdf"];
        }

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

                Database::iud("UPDATE `pdf` SET `code`='" . $pdf_name . "' WHERE `book_id`='" . $bookId . "'");
            }
        } else {
            echo "Please select a valid pdf.";
        }
    }

    // Cover Image
    if (isset($_POST["image"])) {
    } else {
        if (isset($_FILES["image"])) {
            $image = $_FILES["image"];
        }

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

                Database::iud("UPDATE `images` SET `code`='" . $image_name . "' WHERE `book_id`='" . $bookId . "'");
            }
        } else {
            echo "Please select a valid image.";
        }
    }

    Database::iud("UPDATE `book` SET `title`='" . $title . "',`overview`='" . $overview . "',`author`='" . $author . "',`publisher`='" . $publisher . "',
    `published_date`='" . $publishedDate . "',`isbn`='" . $isbn . "',
    `qty`='" . $qty . "',`page_count`='" . $pageCount . "',`price`='" . $price . "',`delivery_fee_colombo`='" . $dwc . "',
    `delivery_fee_other`='" . $doc . "',`description`='" . $description . "' WHERE `id`= '" . $bookId . "'");

    echo "success";
}
