<style>
input[type=text], select {
  width: 40%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
</style>
<div class="ect-box-cpt">
    <p class="meta-options ect_box">
        <input id="ect-column2"
            type="text"
            name="ect-column2"
            placeholder="Column 2"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ect-column2', true ) ); ?>">
        <input id="ect-column2-follow"
            type="text"
            name="ect-column2-follow"
            placeholder="Column 2 follow"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ect-column2-follow', true ) ); ?>">
    </p>
    <p class="meta-options ect_box">
        <input id="ect-column3"
            type="text"
            name="ect-column3"
            placeholder="Column underneath"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ect-column3', true ) ); ?>">
    </p>
    <p class="meta-options ect_box">
        <input id="ect-affiliate-link"
            type="text"
            name="ect-affiliate-link"
            placeholder="Affiliate link"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ect-affiliate-link', true ) ); ?>">
    </p>
    <p class="meta-options ect_box">
        <input id="ect-tc-link"
            type="text"
            name="ect-tc-link"
            placeholder="Link in column underneath"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ect-tc-link', true ) ); ?>">
    </p>
    <p class="meta-options ect_box">
        <input id="ect-outgoing-slug"
            type="text"
            name="ect-outgoing-slug"
            placeholder="Enter a word for the redirect that comes after \go\"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'ect-outgoing-slug', true ) ); ?>">
    </p>
</div>
