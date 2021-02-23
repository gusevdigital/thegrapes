<form id="thegrapes-filter-form" action="#">
  <div class="shop-filters container">
    <div class="row">

      <div class="col-lg-6 mb-4 order-1">
        <a class="btn btn-primary btn-line m-100 filters-button" data-toggle="collapse" data-target="#shop-filters" aria-controls="shop-filters" aria-expanded="false" aria-label="Toggle navigation"><span><?php _e( 'Show filters', 'thegrapes' ); ?></span></a>
      </div>
      <div class="col-lg-6 mb-4 text-lg-right order-3 order-lg-2">
        <?php
        if ( woocommerce_product_loop() ) {

          /**
           * Hook: woocommerce_before_shop_loop.
           *
           * @hooked woocommerce_output_all_notices - 10
           * @hooked woocommerce_result_count - 20
           * @hooked woocommerce_catalog_ordering - 30
           */
          do_action( 'woocommerce_before_shop_loop' );

        }
        ?>
      </div>
      <div class="col-lg-12 order-2 order-lg-3 pb-4">
        <div id="shop-filters" class="collapse">
          <div class="filters-wrap">
            <div class="row">
              <div class="col-xl-4 mb-3">
                <h3 class="text-center"><?php _e( 'Color', 'thegrapes' ); ?></h3>
                <div class="checkboxes d-flex justify-content-center">
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-color-red" name="filterAttrColor[]" value="red" />
                    <span class="checkbox-text"><?php _e( 'Red', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox"  id="filter-color-white" name="filterAttrColor[]" value="white" />
                    <span class="checkbox-text"><?php _e( 'White', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-color-rose" name="filterAttrColor[]" value="rose" />
                    <span class="checkbox-text"><?php _e( 'Rose', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                </div>
              </div>
              <div class="col-xl-4 mb-3">
                <h3 class="text-center"><?php _e( 'Grapes variety', 'thegrapes' ); ?></h3>
                <div class="checkboxes d-flex justify-content-center">
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-grapes-sangiovese" name="filterAttrGrapes[]" value="sangiovese" />
                    <span class="checkbox-text"><?php _e( 'Sangiovese', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-grapes-single" name="filterAttrGrapes[]" value="single-varietal-wine" />
                    <span class="checkbox-text"><?php _e( 'Single varietal wine', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-grapes-multi" name="filterAttrGrapes[]" value="multi-varietal-wine" />
                    <span class="checkbox-text"><?php _e( 'Multi varietal wine', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                </div>
              </div>
              <div class="col-xl-4 mb-3">
                <h3 class="text-center"><?php _e( 'Food paring', 'thegrapes' ); ?></h3>
                <div class="checkboxes d-flex justify-content-center">
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-paring-western" name="filterAttrFood[]" value="food-western" />
                    <span class="checkbox-text"><?php _e( 'Western', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-paring-asian" name="filterAttrFood[]" value="food-asian" />
                    <span class="checkbox-text"><?php _e( 'Asian', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                  <label class="checkbox-container btn btn-outline-primary btn-selector d-flex align-items-center justify-content-center">
                    <input type="checkbox" id="filter-paring-seafood" name="filterAttrFood[]" value="food-seafood" />
                    <span class="checkbox-text"><?php _e( 'Seafood', 'thegrapes' ); ?></span>
                    <svg class="checkmark" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M6.12669 13.9771C5.97396 14.1307 5.76558 14.2164 5.54913 14.2164C5.33267 14.2164 5.1243 14.1307 4.97157 13.9771L0.359012 9.36378C-0.119671 8.8851 -0.119671 8.10888 0.359012 7.6311L0.936573 7.05339C1.4154 6.5747 2.19072 6.5747 2.6694 7.05339L5.54913 9.93326L13.3306 2.15168C13.8094 1.67299 14.5855 1.67299 15.0634 2.15168L15.641 2.72939C16.1196 3.20807 16.1196 3.98413 15.641 4.46207L6.12669 13.9771Z"
                        fill="white" />
                    </svg>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
