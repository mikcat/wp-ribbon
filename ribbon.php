<?php
/*  */

add_action('wp_footer', 'wpribbon_print_ribbon');

function wpribbon_print_ribbon() {
  $options = get_option('wpribbon-settings');

  $style = '<style>';
  $style .= '.icon.icon-wpribbon{position:fixed;';

  if (isset($options['fill'])) {
    $style .= sprintf('fill:%s;', $options['fill']);
  }

  if (isset($options['width'])) {
    $style .= sprintf('width:%s;', $options['width']);
  }

  if (isset($options['height'])) {
    $style .= sprintf('height:%s;', $options['height']);
  }

  if (isset($options['position'])) {
    $style .= $options['position'];
  }

  $style .= '}</style>';

  echo $style;

  $title = isset($options['title']) ? $options['title'] : 'WP Ribbon';
  ?>
  <svg style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>

      <symbol id="icon-wpribbon" viewBox="0 0 20 32">
        <title><?php echo esc_html($title); ?></title>
        <path d="M5.903 2.753c0 0-0.839-1.308-1.953-2.132-0.784-0.175-1.026-0.066-1.899 0.562-1.209 0.869-1.225 1.205-1.225 1.448 0.464 1.795 0.998 2.183 1.382 2.455 0 0-0.026-0.012-0.026-0.012s0.32-2.159 3.721-2.321z"></path>
        <path d="M3.636 0.351c0.369 0.359 1.562 0.993 1.449 1.919 2.956 5.046 0.725 14.232-1.152 20.665 0 0-0.727 2.568-0.54 3.073s0.098 0.455 1.552 1.633c1.289 1.043 2.849 3.042 3.083 4.009l1.843-17.215c0 0 0.064-7.19 0.018-8.62s-0.516-3.236-2.909-4.203c-1.122-0.453-2.543-1.099-3.344-1.259z"></path>
        <path d="M5.903 2.753c0 0-0.157-0.899-1.271-1.723-0.784-0.175-1.495-0.066-2.369 0.562-1.209 0.869-1.255 1.538-1.255 1.781 0.464 1.795 0.816 1.44 1.2 1.712 0 0-0.026-0.012-0.026-0.012s0.32-2.159 3.721-2.321z"></path>
        <path d="M4.632 1.030c0.318 0.345 0.691 1.001 1.035 1.809 2.109 4.942-0.408 13.004-2.027 19.199 0 0-0.628 2.227-0.466 2.713s0.708 1.053 1.964 2.186c1.112 1.004 2.348 1.741 2.551 2.672l1.7-15.142c0 0 0.202-6.923 0.162-8.3s-0.445-3.239-2.51-4.17c-0.968-0.436-1.717-0.812-2.409-0.967z"></path>
        <path d="M1.93 4.227c0 0-0.664-0.926-1.213-1.873 0 0.268-0.167 3.167-0.167 3.167s-0.167 2.052 1.087 3.658c1.255 1.606 5.645 7.628 14.051 13.65 0 0 2.049 1.561 2.634 1.606 0 0 1.045-4.684 0.836-6.379 0 0-2.425-0.937-9.66-6.959s-7.569-6.87-7.569-6.87z"></path>
        <path d="M2.182 5.074c0 0-0.643-0.84-1.174-1.7 0 0.243-0.162 2.874-0.162 2.874s-0.162 1.862 1.053 3.32c1.215 1.457 5.466 6.923 13.603 12.389 0 0 1.984 1.417 2.551 1.457 0 0 1.012-4.251 0.81-5.79 0 0-2.348-0.85-9.352-6.316s-7.328-6.235-7.328-6.235z"></path>
      </symbol>

    </defs>
  </svg>

  <?php if (isset($options['link_url'])) : ?>
    <a href="<?php echo esc_attr($options['link_url']); ?>" title="<?php echo esc_attr($title); ?>" target="_blank">
    <?php endif; ?>
    <svg class="icon icon-wpribbon"><use xlink:href="#icon-wpribbon"></use></svg>
    <?php if (isset($options['link_url'])) : ?>
    </a>
  <?php endif; ?>

  <?php
}
