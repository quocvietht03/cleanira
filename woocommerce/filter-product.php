<?php
/**
 * The Template for displaying products filters
 *
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- Products Filters Form-->
<form id="bt-products-filter-form" onsubmit="return false" method="POST">
    <h2 class="bt-form-title">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
            <path d="M25.2223 5.41737C25.0877 5.10621 24.8645 4.84151 24.5806 4.65618C24.2966 4.47086 23.9645 4.37308 23.6255 4.37503H4.37546C4.03676 4.3757 3.70553 4.47464 3.42196 4.65985C3.13838 4.84506 2.91465 5.10858 2.77789 5.41845C2.64114 5.72831 2.59724 6.07121 2.65153 6.40553C2.70582 6.73985 2.85596 7.05123 3.08374 7.3019L3.09249 7.31175L10.5005 15.2217V23.625C10.5004 23.9418 10.5863 24.2526 10.749 24.5243C10.9116 24.7961 11.145 25.0186 11.4242 25.1681C11.7034 25.3176 12.018 25.3886 12.3343 25.3734C12.6507 25.3582 12.957 25.2575 13.2206 25.0819L16.7206 22.7478C16.9605 22.588 17.1573 22.3714 17.2933 22.1172C17.4294 21.8631 17.5005 21.5793 17.5005 21.291V15.2217L24.9095 7.31175L24.9183 7.3019C25.1485 7.05238 25.3 6.74058 25.3541 6.40543C25.4082 6.07028 25.3624 5.72663 25.2223 5.41737ZM15.9889 14.2822C15.8375 14.4427 15.7524 14.6544 15.7505 14.875V21.291L12.2505 23.625V14.875C12.2505 14.6528 12.1661 14.4389 12.0142 14.2767L4.37546 6.12503H23.6255L15.9889 14.2822Z" fill="#212121"/>
        </svg>
        <span>Filters</span>
    </h2>
    <!-- Search field -->
    <div class="bt-form-field bt-field-type-search">
        <input type="search" id="bt-product-search-keyword" name="keyword" placeholder="Search...">
        <button id="bt-search-product-button" arial-label="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M21.3982 20.6032L16.5814 15.7864C17.955 14.2067 18.6616 12.1554 18.5523 10.065C18.4429 7.97447 17.5262 6.00809 15.9954 4.58032C14.4645 3.15255 12.4391 2.37493 10.3461 2.41138C8.25305 2.44784 6.25594 3.29551 4.77573 4.77573C3.29551 6.25594 2.44784 8.25305 2.41138 10.3461C2.37493 12.4391 3.15255 14.4645 4.58032 15.9954C6.00809 17.5262 7.97447 18.4429 10.065 18.5523C12.1554 18.6616 14.2067 17.955 15.7864 16.5814L20.6032 21.3982C20.7099 21.4976 20.8509 21.5517 20.9966 21.5491C21.1424 21.5465 21.2814 21.4875 21.3845 21.3845C21.4875 21.2814 21.5465 21.1424 21.5491 20.9966C21.5517 20.8509 21.4976 20.7099 21.3982 20.6032ZM3.56324 10.5007C3.56324 9.12863 3.97011 7.78733 4.73242 6.64647C5.49472 5.5056 6.57821 4.61641 7.84587 4.09132C9.11353 3.56624 10.5084 3.42885 11.8542 3.69654C13.1999 3.96422 14.4361 4.62496 15.4063 5.59518C16.3765 6.56541 17.0372 7.80155 17.3049 9.1473C17.5726 10.493 17.4352 11.8879 16.9101 13.1556C16.3851 14.4233 15.4959 15.5068 14.355 16.2691C13.2141 17.0314 11.8728 17.4382 10.5007 17.4382C8.66148 17.436 6.8982 16.7044 5.59765 15.4038C4.2971 14.1033 3.56547 12.34 3.56324 10.5007Z" fill="#212121"/>
            </svg>
        </button>
    </div>
    <!-- .Search field -->
    <!-- Price field -->
    <div class="bt-form-field bt-field-price">
        <label for="bt-price-slider">Price</label>
        <div id="bt-price-slider"></div>
        <div class="bt-field-price-options">
            <div class="bt-field-min-price">
                <label for="bt-min-price">Min price</label>
                <input type="number" id="bt-min-price" name="min_price" value="">
            </div>
            <div class="bt-field-max-price">
                <label for="bt-max-price">Max price</label>
                <input type="number" id="bt-max-price" name="max_price" value="">
            </div>
        </div>
    </div>
    <!-- .Price field -->
    <!-- Taxonomies field -->
    <div class="bt-form-field bt-field-taxonomies"></div>
    <!-- .Taxonomies field -->
</form>
<!-- #Products Filters Form-->