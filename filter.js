function filter_data(page) {
    var action = 'fetchdata';
    var category = get_filter('category');
    var searchQuery = document.getElementById('search').value.trim();
    var sortAlphabetically = document.getElementById('sort_alphabetically').checked;
    var stockFilter = document.getElementById('stock_filter').checked;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "productDAO.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            update_products_display(response);
        }
    };

    var data = "action=" + action +
        "&category=" + JSON.stringify(category) +
        "&searchFilter=" + searchQuery +
        "&sort_alphabetically=" + (sortAlphabetically ? 1 : 0) +
        "&stock_filter=" + (stockFilter ? 1 : 0) +
        "&page=" + page;

    xhr.send(data);
}

function get_filter(class_name) {
    var filter = [];
    var checkboxes = document.querySelectorAll('.' + class_name + ':checked');
    checkboxes.forEach(function (checkbox) {
        filter.push(checkbox.value);
    });

    return filter;
}

document.getElementById('search').addEventListener('input', function () {
    filter_data(1); // Reset to the first page when searching
});

document.querySelectorAll('.common_selector').forEach(function (selector) {
    selector.addEventListener('change', function () {
        filter_data(1); 
    });
});

// Initial load
filter_data(1);
