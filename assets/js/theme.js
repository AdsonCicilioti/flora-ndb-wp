/**
 * NOT FOUND RESULTS
 */
function NoResultsFeedback(title, results, message) {
  if (!title || !results) {
    // console.log(title, results);
    return;
  }

  var old_text = title.innerText;

  title.innerText = message ? message + " " + old_text : "Nada Encontrado!";
  results.remove();
}

window.addEventListener("load", () => {
  // SEARCH NO RESULTS
  var page_title = document.querySelector(
    "body.search-no-results .change-title-no-result h1 > span"
  );
  var section_results = document.querySelector(
    "body.search-no-results .destroy-no-results"
  );
  NoResultsFeedback(page_title, section_results);

  // CATEGORY and TAGS NO RESULTS
  var cat_page_title = document.querySelector(
    ".change-title-no-result h1 > span"
  );
  var posts_results = document.querySelector(".posts-no-results");
  var has_children =
    !posts_results || posts_results.querySelectorAll(".brz-posts__item");
  if (has_children && has_children.length === 0) {
    // console.log(has_children, "NADA");
    NoResultsFeedback(cat_page_title, posts_results, "Nada com a ");
  }

  // INSTAGRAM FEED
  var xhr = new XMLHttpRequest(),
    elementId = "#fnb-feed-insta",
    container = document.querySelector(elementId),
    profileId = "5748260655",
    tkn_ =
      "IGQVJXaEo3cmxVUzFlSXl6dVZA3NlkyRTNydzh1ZA0tDRUt0TUlTNHhvc3E2VldNeHFrMW16ZAVl2Y0treG82eHRMRFZAsandDX29wNXVlRjNRMk5HNmxRMmdDYWNQVkVmU2thZA3RIOFNxVGY1cTctVi1lVwZDZD";

  xhr.open(
    "GET",
    "https://graph.instagram.com/" +
      profileId +
      "/media?fields=caption,permalink,media_url,thumbnail_url,media_type&limit=12&access_token=" +
      tkn_
  );
  xhr.setRequestHeader("Access-Control-Allow-Origin", "*");
  xhr.setRequestHeader("Vary", "Origin");
  xhr.setRequestHeader("Access-Control-Allow-Methods", "GET");
  xhr.setRequestHeader(
    "Access-Control-Allow-Headers",
    "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers"
  );
  xhr.setRequestHeader("Content-Type", "application/json");

  xhr.onreadystatechange = function () {
    if (this.readyState === 4) {
      if (xhr.status === 200) {
        var feed = JSON.parse(xhr.responseText);
        console.log(feed.data);

        for (let index = 0; index < feed.data.length; index++) {
          var post = feed.data[index],
            caption = post.caption.length > 55 && post.caption.substring(0, 55),
            thumb =
              post.media_type === "VIDEO" ? post.thumbnail_url : post.media_url;

          container.innerHTML +=
            '<a target="_blank" href="' +
            post.permalink +
            '"><img src="' +
            thumb +
            '" alt="' +
            caption +
            '"/><p class="caption">' +
            caption +
            "...</p></a>";
        }
      } else {
        console.log("Erro");
        console.log(xhr);
      }
    }
  };
  xhr.send();
});
