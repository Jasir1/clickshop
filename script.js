function changeView() {

    var signUpBox = document.getElementById("signUpBox");
    var signInBox = document.getElementById("signInBox");

    signUpBox.classList.toggle("d-none");
    signInBox.classList.toggle("d-none");

}

var userErrorModal1;

function signUp() {
    var username = document.getElementById("username");
    var email = document.getElementById("email");
    var password = document.getElementById("password");
    var confirmpassword = document.getElementById("confirmpassword");
    var mobile = document.getElementById("mobile");
    var gender = document.getElementById("gender");

    var form = new FormData();
    form.append("username", username.value);
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("confirmpassword", confirmpassword.value);
    form.append("mobile", mobile.value);
    form.append("gender", gender.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {

        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                username.value = "";
                email.value = "";
                password.value = "";
                confirmpassword.value = "";
                mobile.value = "";
                gender.value = "";
                // document.getElementById("error-msg1").innerHTML = "";
                var m = document.getElementById("userErrorModal1");
                userErrorModal1 = new bootstrap.Modal(m);
                userErrorModal1.show();
                document.getElementById("modalStatus").className = "success_message";
                document.getElementById("error-msg1").innerHTML = "Account created successfully.";

                changeView();
            } else {
                var m = document.getElementById("userErrorModal1");
                userErrorModal1 = new bootstrap.Modal(m);
                userErrorModal1.show();

                document.getElementById("modalStatus").className = "warning_message";
                document.getElementById("error-msg1").innerHTML = text;
            }
        }

    };
    r.open("POST", "signUpProcess.php", true);
    r.send(form);
}

var userErrorModal2;

function signIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "home.php";
            } else {
                // document.getElementById("error-msg2").innerHTML = text;
                var m = document.getElementById("userErrorModal2");
                userErrorModal2 = new bootstrap.Modal(m);
                userErrorModal2.show();

                document.getElementById("error-msg2").innerHTML = text;
            }
        }
    }
    r.open("POST", "signInProcess.php", true);
    r.send(form);
}

var adminSigninResponseModal;

function adminSignIn() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password");
    var rememberMe = document.getElementById("rememberMe");

    var form = new FormData();
    form.append("email", email.value);
    form.append("password", password.value);
    form.append("rememberMe", rememberMe.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {

                window.location = "adminPanel.php";
            } else {
                var m = document.getElementById("adminSigninResponseModal");
                adminSigninResponseModal = new bootstrap.Modal(m);
                adminSigninResponseModal.show();

                document.getElementById("responseMessage").innerHTML = text;
            }
        }
    }
    r.open("POST", "AdminSignInProcess.php", true);
    r.send(form);
}

var passwordResetModal;
var forgotPasswordModal;

function forgotPassword() {
    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                var modal1 = document.getElementById("forgotPasswordModal");
                forgotPasswordModal = new bootstrap.Modal(modal1);
                forgotPasswordModal.show();
                document.getElementById("responseMessages").innerHTML = "Verification Code Sent to Your Email.Please Check Your Email";

                var closeModal = document.getElementById("closeModal");
                closeModal.addEventListener("click", e => {
                    forgotPasswordModal.hide();
                    var modal2 = document.getElementById("passwordResetModal");
                    passwordResetModal = new bootstrap.Modal(modal2);
                    passwordResetModal.show();
                })

            } else {
                alert(text);
            }
        }
    };

    r.open("GET", "ForgotPasswordProcess.php?email=" + email.value, true);
    r.send();
}

function showbtn1() {

    var newPassword = document.getElementById("newPassword");
    var newPasswordShow = document.getElementById("newPasswordShow");

    if (newPasswordShow.innerHTML == "Show") {

        newPassword.type = "text";
        newPasswordShow.innerHTML = "Hide";

    } else {

        newPassword.type = "password";
        newPasswordShow.innerHTML = "Show";

    }
}

function showbtn2() {

    var confirmPassword = document.getElementById("confirmPassword");
    var confirmPasswordShow = document.getElementById("confirmPasswordShow");

    if (confirmPasswordShow.innerHTML == "Show") {

        confirmPassword.type = "text";
        confirmPasswordShow.innerHTML = "Hide";

    } else {

        confirmPassword.type = "password";
        confirmPasswordShow.innerHTML = "Show";

    }
}

function passwordReset() {
    var email = document.getElementById("email2");
    var newPassword = document.getElementById("newPassword");
    var confirmPassword = document.getElementById("confirmPassword");
    var code = document.getElementById("code");

    var form = new FormData();
    form.append("email", email.value);
    form.append("newPassword", newPassword.value);
    form.append("confirmPassword", confirmPassword.value);
    form.append("code", code.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                alert("Password reset success.");
                bootstrapModal.hide();
            }
        }
    };

    r.open("POST", "resetPassword.php", true);
    r.send(form);

}
var logOutConfirmationModal;

function logOutConfirmation() {
    var m = document.getElementById("logOutConfirmationModal");
    var logOutConfirmationModal = new bootstrap.Modal(m);
    logOutConfirmationModal.show();
}

function logOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "home.php";
            }
        }
    }

    r.open("GET", "logOutProcess.php", true);
    r.send();
}

var adminLogOutConfirmationModal;

function adminLogOutConfirmation() {
    var m = document.getElementById("adminLogOutConfirmationModal");
    var adminLogOutConfirmationModal = new bootstrap.Modal(m);
    adminLogOutConfirmationModal.show();
}


function adminLogOut() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "adminSignin.php";
            }
        }
    }

    r.open("GET", "adminLogOutProcess.php", true);
    r.send();
}

function changeImg() {
    var image = document.getElementById("profile_img");
    var view = document.getElementById("prev");

    image.onchange = function () {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        view.src = url;
    }
}

var updateProfileModal;
// perfect///////////////////////////////////////
function updateProfile() {
    var firstName = document.getElementById("first_name");
    var lastName = document.getElementById("last_name");
    var address1 = document.getElementById("address1");
    var address2 = document.getElementById("address2");
    var city = document.getElementById("city");
    var postalCode = document.getElementById("postal_code");
    var image = document.getElementById("profile_img")
    var username = document.getElementById("username")
    var password = document.getElementById("password")
    var mobile = document.getElementById("mobile")


    var form = new FormData();
    form.append("fname", firstName.value);
    form.append("lname", lastName.value);
    form.append("add1", address1.value);
    form.append("add2", address2.value);
    form.append("city", city.value);
    form.append("pcode", postalCode.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("mobile", mobile.value);
    form.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                document.getElementById("modalStatus").className = "success_message";
                var m = document.getElementById("updateProfileModal");
                updateProfileModal = new bootstrap.Modal(m);
                updateProfileModal.show();

                document.getElementById("updateProfileModalMsg").innerHTML = "Profile updated successfully";

            } else {
                document.getElementById("modalStatus").className = "warning_message";
                var m = document.getElementById("updateProfileModal");
                updateProfileModal = new bootstrap.Modal(m);
                updateProfileModal.show();

                document.getElementById("updateProfileModalMsg").innerHTML = text;
            }
        }
    }

    r.open("POST", "updateProfileProcess.php", true);
    r.send(form);

}


function updateAdminProfile() {
    var firstName = document.getElementById("first_name");
    var lastName = document.getElementById("last_name");
    var image = document.getElementById("profile_img")
    var username = document.getElementById("username")
    var password = document.getElementById("password")
    var mobile = document.getElementById("mobile")


    var form = new FormData();
    form.append("fname", firstName.value);
    form.append("lname", lastName.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("mobile", mobile.value);
    form.append("image", image.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            var m = document.getElementById("updateProfileModal");
            updateProfileModal = new bootstrap.Modal(m);
            updateProfileModal.show();

            document.getElementById("updateProfileModalMsg").innerHTML = text;
            window.location = "adminProfile.php";
        }
    }

    r.open("POST", "adminUpdateProfileProcess.php", true);
    r.send(form);

}

function pswd_addon() {

    var show_text = document.getElementById("password");
    var img_show = document.getElementById("img_show");
    var img_hide = document.getElementById("img_hide");

    var show = img_show.classList.toggle("d-none");
    var hide = img_hide.classList.toggle("d-none");

    if (hide == false) {

        show_text.type = "text";
        img_hide.className = "bi-eye-slash-fill";

    } else {

        show_text.type = "password";
        img_show.className = "bi-eye-fill";

    }
}

function changeCoverImage() {
    var image = document.getElementById("imageUploader");
    var view = document.getElementById("imagePrev");
    var allowedExtension = /(\.jpg|\.jpeg|\.png|\.svg)$/i;

    image.onchange = function () {
        if (!allowedExtension.exec(image.value)) {
            view.src = "icons/image-file.png";
        } else {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);
            view.src = url;
        }
    }
}

function changePdf() {
    var pdf = document.getElementById("pdfUploader");
    var view = document.getElementById("pdfPrev");

    pdf.onchange = function () {
        var allowedExtension = /(\.pdf)$/i;
        if (allowedExtension.exec(pdf.value)) {
            view.src = "resources/acrobat_reader.png";
        } else {
            var file = this.files[0];
            var url = window.URL.createObjectURL(file);
            view.src = url;
        }
    }
}


// function fileValidation() {
//     var fileInput = document.getElementById('file');
//     var filePath = fileInput.value;
//     var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
//     if (!allowedExtensions.exec(filePath)) {
//         alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
//         fileInput.value = '';
//         return false;
//     } else {
//         //Image preview
//         if (fileInput.files && fileInput.files[0]) {
//             var reader = new FileReader();
//             reader.onload = function(e) {
//                 document.getElementById('imagePreview').innerHTML = '<img src="' + e.target.result + '"/>';
//             };
//             reader.readAsDataURL(fileInput.files[0]);
//         }
//     }
// }


var addBookModal;

function addBook() {
    var category = document.getElementById("category");
    var genre = document.getElementById("genre");
    var title = document.getElementById("title");
    var author = document.getElementById("author");
    var publisher = document.getElementById("publisher");
    var publishedDate = document.getElementById("publishedDate");
    var isbn = document.getElementById("isbn");
    var language = document.getElementById("language");
    var qty = document.getElementById("qty");
    var pageCount = document.getElementById("pageCount");
    var price = document.getElementById("price");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("description");
    var overview = document.getElementById("overview");
    var image = document.getElementById("imageUploader");
    var pdf = document.getElementById("pdfUploader");

    var form = new FormData();
    form.append("category", category.value);
    form.append("genre", genre.value);
    form.append("title", title.value);
    form.append("author", author.value);
    form.append("publisher", publisher.value);
    form.append("publishedDate", publishedDate.value);
    form.append("isbn", isbn.value);
    form.append("language", language.value);
    form.append("qty", qty.value);
    form.append("pageCount", pageCount.value);
    form.append("price", price.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("description", description.value);
    form.append("overview", overview.value);
    form.append("image", image.files[0]);
    form.append("pdf", pdf.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                var m = document.getElementById("responseModal");
                addBookModal = new bootstrap.Modal(m);
                addBookModal.show();

                document.getElementById("responseMessages").innerHTML = "Book added successfully.";

                // window.location = "addbook.php";

                setTimeout(function time() {
                    window.location.reload();
                }, 1500);
            } else {
                var m = document.getElementById("errorMsgModal");
                addBookModal = new bootstrap.Modal(m);
                addBookModal.show();

                document.getElementById("errorMessages").innerHTML = text;
            }
        }
    };
    r.open("POST", "addBookProcess.php", true);
    r.send(form);

}

var updateBookModal;

function updateBook() {
    var title = document.getElementById("title");
    var author = document.getElementById("author");
    var publisher = document.getElementById("publisher");
    var publishedDate = document.getElementById("publishedDate");
    var isbn = document.getElementById("isbn");
    // var language = document.getElementById("language");
    var qty = document.getElementById("qty");
    var pageCount = document.getElementById("pageCount");
    var price = document.getElementById("price");
    var dwc = document.getElementById("dwc");
    var doc = document.getElementById("doc");
    var description = document.getElementById("description");
    var overview = document.getElementById("overview");
    var image = document.getElementById("imageUploader");
    var pdf = document.getElementById("pdfUploader");

    var form = new FormData();
    form.append("title", title.value);
    form.append("author", author.value);
    form.append("publisher", publisher.value);
    form.append("publishedDate", publishedDate.value);
    form.append("isbn", isbn.value);
    // form.append("language", language.value);
    form.append("qty", qty.value);
    form.append("pageCount", pageCount.value);
    form.append("price", price.value);
    form.append("dwc", dwc.value);
    form.append("doc", doc.value);
    form.append("description", description.value);
    form.append("overview", overview.value);
    form.append("image", image.files[0]);
    form.append("pdf", pdf.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                var m = document.getElementById("updateBookModal");
                addBookModal = new bootstrap.Modal(m);
                addBookModal.show();

                window.history.back();
                // window.location.reload();

            } else {
                var m = document.getElementById("errorMsgModal");
                addBookModal = new bootstrap.Modal(m);
                addBookModal.show();

                document.getElementById("errorMessages").innerHTML = text;
            }
        }
    };
    r.open("POST", "updateBookProcess.php", true);
    r.send(form);

}


function changeStatus(id) {
    var bookId = id;
    var statusChange = document.getElementById("flexSwitchCheckChecked");
    var statusLabel = document.getElementById("checkLabel" + bookId);

    var status;
    if (statusChange.checked) {
        status = 0;
    } else {
        status = 1;
    }

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Deactivated") {
                statusLabel.innerHTML = "Make Your Book Active";
            } else if (text == "Activated") {
                statusLabel.innerHTML = "Make Your Book Deactive";
            }
        }
    }
    r.open("GET", "statusChangeProcess.php?b=" + bookId + "&s=" + status, true);
    r.send();
}

function sortBooks() {
    var search = document.getElementById("search");
    var time;
    if (document.getElementById("tn").checked) {
        time = 1;
    } else if (document.getElementById("to").checked) {
        time = 2;
    } else {
        time = 0;
    }

    var price;
    if (document.getElementById("ph").checked) {
        price = 1;
    } else if (document.getElementById("pl").checked) {
        price = 2;
    } else {
        price = 0;
    }

    var qty;
    if (document.getElementById("qh").checked) {
        qty = 1;
    } else if (document.getElementById("ql").checked) {
        qty = 2;
    } else {
        qty = 0;
    }

    var form = new FormData();
    form.append("s", search.value);
    form.append("t", time);
    form.append("p", price);
    form.append("q", qty);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            // document.getElementById("pagination").style.display = "none";
            document.getElementById("sort").innerHTML = text;
        }
    }
    r.open("POST", "sortProcess.php", true);
    r.send(form);

}

function sendId(id) {
    var newId = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "success") {
                window.location = "updateBook.php";
            }
        }
    };
    r.open("GET", "sendProcess.php?id=" + newId, true);
    r.send();
}


function advancedSearchButton() {
    var advancedDiv = document.getElementById("advancedDiv");
    var homeContent = document.getElementById("homeContent");
    var advanceShow = document.getElementById("advanceShow");

    advancedDiv.classList.toggle("d-none");
    homeContent.classList.toggle("d-none");
    advanceShow.classList.toggle("d-none");
}

function advancedSearch(x) {

    var searchTitle = document.getElementById("searchTitle");
    var searchAuthor = document.getElementById("searchAuthor");
    var selectCategory = document.getElementById("selectCategory");
    var selectGenre = document.getElementById("selectGenre");
    var selectLanguage = document.getElementById("selectLanguage");
    var priceFrom = document.getElementById("priceFrom");
    var priceTo = document.getElementById("priceTo");
    var pageFrom = document.getElementById("pageFrom");
    var pageTo = document.getElementById("pageTo");

    var form = new FormData();
    form.append("page", x);
    form.append("st", searchTitle.value);
    form.append("sa", searchAuthor.value);
    form.append("sc", selectCategory.value);
    form.append("sg", selectGenre.value);
    form.append("sl", selectLanguage.value);
    form.append("pf", priceFrom.value);
    form.append("pt", priceTo.value);
    form.append("pgf", pageFrom.value);
    form.append("pgt", pageTo.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            // alert(text);
            document.getElementById("advanceShow").innerHTML = text;
        }
    };
    r.open("POST", "advancedSearchProcess.php", true);
    r.send(form);

}

function basicSearch(x) {
    var basicSearch = document.getElementById("basic_search");
    var basicSelect = document.getElementById("basic_select");

    var form = new FormData();
    form.append("page", x);
    form.append("sr", basicSearch.value);
    form.append("sl", basicSelect.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("homeContent").innerHTML = text;
            // alert(text);
        }
    };
    r.open("POST", "basicSearchProcess.php", true);
    r.send(form);
}

function clearSearch() {

    window.location = "home.php";

    // document.getElementById("searchTitle").innerHTML = "";

    // document.getElementById("advancedDiv").classList.toggle("d-none");
    // document.getElementById("homeContent").classList.toggle("d-none");
    // document.getElementById("advanceShow").classList.toggle("d-none");

    // document.getElementById("advanceShow").classList.toggle("d-none");
}

function clearFilters() {
    window.location = "myBooks.php";
}

function viewOptionOnload() {

    var overview = document.getElementById("overview");
    var details = document.getElementById("details");
    var reviews = document.getElementById("reviews");
    var feedback = document.getElementById("feedback");

    overview.style.display = "block";
    details.style.display = "none";
    reviews.style.display = "none";
    feedback.style.display = "none";

}

function overviewOption() {

    var overview = document.getElementById("overview");
    var details = document.getElementById("details");
    var reviews = document.getElementById("reviews");
    var feedback = document.getElementById("feedback");

    if (overview.style.display = "block") {
        overview.style.display = "block";
        details.style.display = "none";
        reviews.style.display = "none";
        feedback.style.display = "none";
    }
}

function detailsOption() {

    var overview = document.getElementById("overview");
    var details = document.getElementById("details");
    var reviews = document.getElementById("reviews");
    var feedback = document.getElementById("feedback");

    if (details.style.display = "block") {
        details.style.display = "block";
        overview.style.display = "none";
        reviews.style.display = "none";
        feedback.style.display = "none";
    }
}

function reviewsOption() {

    var overview = document.getElementById("overview");
    var details = document.getElementById("details");
    var reviews = document.getElementById("reviews");
    var feedback = document.getElementById("feedback");

    if (reviews.style.display = "block") {
        reviews.style.display = "block";
        details.style.display = "none";
        overview.style.display = "none";
        feedback.style.display = "none";
    }
}

function feedbackOption() {

    var overview = document.getElementById("overview");
    var details = document.getElementById("details");
    var reviews = document.getElementById("reviews");
    var feedback = document.getElementById("feedback");

    if (feedback.style.display = "block") {
        feedback.style.display = "block";
        reviews.style.display = "none";
        details.style.display = "none";
        overview.style.display = "none";
    }
}

var svw;

function emptyWatchlist() {
    // var m = document.getElementById("watchlistErrorModal");
    // svw = new bootstrap.Modal(m);
    // svw.show();
    // alert("Please Sign In first");
    // window.location = "index.php";
}
var addToWatclistModal;

function addToWatchlist(id) {

    var wid = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "Added") {
                var m = document.getElementById("addToWatclistModal");
                addToWatclistModal = new bootstrap.Modal(m);
                addToWatclistModal.show();

                document.getElementById("addToWatclistMsg").innerHTML = "Book added to watchlist successfully.";
            } else if (text == "Deleted") {
                var m = document.getElementById("addToWatclistModal");
                addToWatclistModal = new bootstrap.Modal(m);
                addToWatclistModal.show();

                document.getElementById("addToWatclistMsg").innerHTML = "Book removed successfully from watchlist.";
            }
            setTimeout(function time() {
                window.location.reload();
            }, 1500);

        }
    }
    r.open("GET", "addToWatchlistProcess.php?id=" + wid, true);
    r.send();
}

function deleteFromWatchlist(id) {

    var bookId = id;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "watchlist.php";
            } else {
                alert(text);
            }
        }
    }
    r.open("GET", "deleteWatchlistProcess.php?id=" + bookId, true);
    r.send();
}

var addToCartModal;

function addToCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "Please Sign In first.") {
                alert(text);
                window.location = "index.php";
            } else {

                var m = document.getElementById("addToCartModal");
                addToCartModal = new bootstrap.Modal(m);
                addToCartModal.show();

                document.getElementById("addToCartMsg").innerHTML = text;

            }
            setTimeout(function time() {
                window.location = "cart.php";
            }, 1500);
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();
}

function deleteFromCart(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location.reload();
            }
        }
    }
    r.open("GET", "removeCartProcess.php?id=" + id, true);
    r.send();
}

function watchlistSearch() {

    var watchlistSearch = document.getElementById("watchlist_search");

    var form = new FormData();
    // form.append("page", x);
    form.append("sr", watchlistSearch.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("watchlistContent").innerHTML = text;
        }
    };
    r.open("POST", "watchlistSearchProcess.php", true);
    r.send(form);
}

function cartSearch() {

    var cartSearch = document.getElementById("cart_search");

    var form = new FormData();
    // form.append("page", x);
    form.append("sr", cartSearch.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("cartContent").innerHTML = text;
        }
    };
    r.open("POST", "cartSearchProcess.php", true);
    r.send(form);
}

function deleteFromWatchlist(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "success") {
                window.location = "watchlist.php";
            }
        }
    }
    r.open("GET", "removeWatchlistProcess.php?id=" + id, true);
    r.send();
}

function adminSignin() {
    window.location = "adminSignin.php";
}

function customerLogin() {
    window.location = "index.php";
}

// /////////////////////////////
function viewRecent() {

    var msgbox = document.getElementById("message_box");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // alert(t);
        }
    }
    r.open("GET", "viewRecentMsgProcess.php", true);
    r.send();
}

function viewMessages(email) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }
    r.open("GET", "viewMessagesProcess.php?email=" + email, true);
    r.send();
}



function bookBlock(id) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            window.location.reload();
        }
    };
    r.open("GET", "bookBlockProcess.php?id=" + id, true);
    r.send();
}

function userBlock(email) {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var text = r.responseText;
            window.location.reload();
        }
    };
    r.open("GET", "userBlockProcess.php?email=" + email, true);
    r.send();
}

var buynowWarningModal;
function buynowWarning() {
    var m = document.getElementById("buynowWarningModal");
    var buynowWarningModal = new bootstrap.Modal(m);
    buynowWarningModal.show();
}

function goBack(){
    window.location.back();
}


function buynow(id) {

    var book_id = id;
    var book_qty = document.getElementById("qtyinput");


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;

            if (t == "2") {
                alert("Invalid Book!");
            } else if (t == "3") {
                window.location = index.php;
            } else {
                var j = JSON.parse(t);

                payhere.onCompleted = function onCompleted(orderId) {

                    setTimeout(buynowprocess(id), 200);
                    // window.location = "invoice.php?order_id=" + orderId;

                };


                payhere.onDismissed = function onDismissed() {

                    alert("Payment dismissed");
                };


                payhere.onError = function onError(error) {

                    alert("Invalid Details");
                };


                var payment = {
                    "sandbox": true,
                    "merchant_id": "1221419", // Replace your Merchant ID
                    "return_url": undefined, // Important
                    "cancel_url": undefined, // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": id,
                    "items": j.bt,
                    "amount": j.btp,
                    "currency": "LKR",
                    "first_name": j.ufn,
                    "last_name": j.uln,
                    "email": "",
                    "phone": j.um,
                    "address": "No.1, Galle Road",
                    "city": "Colombo",
                    "country": "Sri Lanka",
                    "delivery_address": "No. 46, Galle road, Kalutara South",
                    "delivery_city": "Kalutara",
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                payhere.startPayment(payment);


            }
        }
    }
    r.open("GET", "buyNow.php?bid=" + book_id + "&bqty=" + book_qty.value, true);
    r.send();

}

function buynowprocess(id) {

    var book_id = id;
    var book_qty = document.getElementById("qtyinput");

    var f = new FormData();
    f.append("bid", book_id);
    f.append("bqty", book_qty.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            window.location = "invoice.php?order_id=" + t;
            // alert(t);
        }
    }
    r.open("GET", "buyNowProcess.php?bid=" + book_id + "&bqty=" + book_qty.value, true);
    r.send();

}

function printInvoice() {

    var restorePage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorePage;
}

function check_qty(qty) {
    var book_qty = qty;
    var input = document.getElementById("qtyinput");
    if (input.value >= book_qty) {
        alert("Maximum quantity has achieved.");
        document.getElementById("qtyinput").innerHTML = book_qty;
        stop();
    }
    // alert("ok");
}

function seeAllBooks(id) {
    var cid = id;
    window.location = "seeAllBooks.php?cid=" + cid;
}

function feedbackSend(id) {
    var book_id = id;
    window.location = "singleProductView.php?id=" + book_id;
}

var saveFeedbackModal;
var feedbackErrorModal;

function saveFeed(id) {

    var type;

    if (document.getElementById("r1").checked) {
        type = 1;
    } else if (document.getElementById("r2").checked) {
        type = 2;
    } else if (document.getElementById("r3").checked) {
        type = 3;
    }

    var feedback = document.getElementById("f").value;
    var bookid = id;

    var f = new FormData();
    f.append("t", type);
    f.append("f", feedback);
    f.append("i", bookid);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                var m = document.getElementById("saveFeedbackModal");
                saveFeedbackModal = new bootstrap.Modal(m);
                saveFeedbackModal.show();

                window.location = "singleProductView.php?id=" + bookid;

            } else {
                var m = document.getElementById("feedbackErrorModal");
                feedbackErrorModal = new bootstrap.Modal(m);
                feedbackErrorModal.show();

                document.getElementById("feedbackErrorMsg").innerHTML = t;
            }
        }
    }
    r.open("POST", "saveFeedbackProcess.php", true);
    r.send(f);
}

function viewRecent() {

    var msgbox = document.getElementById("message_box");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // msgbox.innerHTML = t;
        }
    }
    setInterval(viewMessages(email), 500);

    r.open("GET", "viewRecentMsgProcess.php", true);
    r.send();
}

function viewAdminRecent() {

    var msgbox = document.getElementById("message_box");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            // msgbox.innerHTML = t;
        }
    }
    setInterval(viewMessages(email), 500);

    r.open("GET", "viewAdminRecentMsgProcess.php", true);
    r.send();
}

function viewMessages(email) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }
    r.open("GET", "viewMessagesProcess.php?email=" + email, true);
    r.send();
}

function viewAdminMessages(email) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("chat_box").innerHTML = t;
        }
    }
    r.open("GET", "viewAdminMessagesProcess.php?email=" + email, true);
    r.send();
}

function sendMsg() {
    // var recever_mail = document.getElementById("rmail");
    var msg_txt = document.getElementById("msgTxt");

    var f = new FormData();
    // f.append("r", recever_mail.innerHTML);
    f.append("m", msg_txt.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "sendMsgProcess.php", true);
    r.send(f);
}

function sendAdminMsg(recever_mail) {
    var recever_mail = document.getElementById("rmail");
    var msg_txt = document.getElementById("msgTxt");

    var f = new FormData();
    f.append("r", recever_mail.innerHTML);
    f.append("m", msg_txt.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }
    r.open("POST", "sendAdminMsgProcess.php", true);
    r.send(f);
}

function navigationStatus() {
    var btn = document.getElementById('dashboard');
    btn.style.backgroundColor = 'red';
}


function gohome() {
    window.history.back();
}

function pageRefresh() {
    window.location.reload();
}

var checkoutListModal;

function checkoutListModal() {

    var m = document.getElementById("checkoutListModal");
    var checkoutListModal = new bootstrap.Modal(m);
    checkoutListModal.show();
}
//////////////////// purchase History single clear
var purchaseHistoryClearModal;
function purchaseHistoryClearModal() {

    var m = document.getElementById("purchaseHistoryClearModal");
    var purchaseHistoryClearModal = new bootstrap.Modal(m);
    purchaseHistoryClearModal.show();
}

function removeBookFromPurchaseHistory(id) {
    var id = id;
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "purchaseHistory.php";
            }
        }
    }
    r.open("POST", "removeBookFromPurchaseHistory.php", true);
    r.send(f);
}

/////////////////// purchase history all clear
var purchaseHistoryClearAllModal;
function purchaseHistoryClearAllModal() {

    var m = document.getElementById("purchaseHistoryClearAllModal");
    var purchaseHistoryClearAllModal = new bootstrap.Modal(m);
    purchaseHistoryClearAllModal.show();
}

function removeAllFromPurchaseHistory(email) {
    var email = email;
    var f = new FormData();
    f.append("email", email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "purchaseHistory.php";
            }
        }
    }
    r.open("POST", "removeAllFromPurchaseHistory.php", true);
    r.send(f);
}


function checkoutList() {
    ///////////////////////////////////////////not work
    // const i =[];
    // i = document.querySelector('input[type="checkbox"]:checked');
    // alert(i[0].value);


    //////////////////////////////////////////not work
    // let btnShow = document.querySelector('button');
    // let result = document.querySelector('h1');
    // btnShow.addEventListener('click', () => {
    //     let checkbox = document.querySelector('input[type="checkbox"]:checked');
    //     result.innerText = checkbox.parentElement.textContent;
    // });


    //////////////////////////////////////////////not work
    // var checkboxArr = [];
    // $('input[type=checkbox]').each(function () {
    //     checkboxArr.push(this);
    // });
    // alert(checkboxArr.values);


    ///////////////////////////////// work
    // var i ;
    // var i = document.querySelector('input[type="checkbox"]:checked');
    // alert(i.value);

    var checkboxArr = [];
    checkboxArr = document.querySelector('input[type="checkbox"]:checked').each(function () {
        checkboxArr.push(this);
    });
    alert(checkboxArr.value);
}