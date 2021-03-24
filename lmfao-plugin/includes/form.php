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
<div class="lmfao-box-cpt">
    <p class="meta-options lmfao_box">
        <input id="lmfao-column2"
            type="text"
            name="lmfao-column2"
            placeholder="Column 2"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lmfao-column2', true ) ); ?>">
        <input id="lmfao-column2-follow"
            type="text"
            name="lmfao-column2-follow"
            placeholder="Column 2 follow"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lmfao-column2-follow', true ) ); ?>">
    </p>
    <p class="meta-options lmfao_box">
        <input id="lmfao-column3"
            type="text"
            name="lmfao-column3"
            placeholder="Column underneath"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lmfao-column3', true ) ); ?>">
    </p>
    <p class="meta-options lmfao_box">
        <input id="lmfao-affiliate-link"
            type="text"
            name="lmfao-affiliate-link"
            placeholder="Affiliate link"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lmfao-affiliate-link', true ) ); ?>">
    </p>
    <p class="meta-options lmfao_box">
        <input id="lmfao-tc-link"
            type="text"
            name="lmfao-tc-link"
            placeholder="Link in column underneath"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lmfao-tc-link', true ) ); ?>">
    </p>
    <p class="meta-options lmfao_box">
        <input id="lmfao-outgoing-slug"
            type="text"
            name="lmfao-outgoing-slug"
            placeholder="Enter a word for the redirect that comes after \go\"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'lmfao-outgoing-slug', true ) ); ?>">
    </p>
</div>
