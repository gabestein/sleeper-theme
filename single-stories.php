<?php get_header(); ?>

<?php if (have_posts()) { while (have_posts()) { the_post(); ?>
<section class="recommender top">
  <?php

    $prev_post = get_previous_post(true);
    if($prev_post !== '') {
      article_card($prev_post->ID, 'prev');
    }

    $next_post = get_next_post(true);
    if($next_post !== '') {
      article_card($next_post->ID, 'next');
    }

    //get our actions
    action_unit();

  ?>
</section>
<article class="single" id="<?php the_ID(); ?>">
    <?php $imgsrc = wp_get_attachment_url(get_post_thumbnail_id()); ?>

    <!--<style>
    article.single header:before {
      background-image: url(<?php echo $imgsrc; ?>);
    }
  </style>-->

    <header>
        <div class="intro-text" >
            <?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
            <h4><?php my_post_number(); ?></h4>
            <h2><a href="<?php the_permalink(); ?>" title="permanent link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
        </div>
    </header>
    <section class="body">
        <?php the_content('Read More'); ?>
        <?php wp_link_pages(array('before' => '<div class="paginate">Page:', 'after' => '</div>', 'next_or_number' => 'number')); ?>
    </section>
    <footer>
        <?php $connected = new WP_Query( array(
          'connected_type' => 'posts_to_posts',
          'connected_items' => $post,
          'nopaging' => true,
          ) );
          if($connected->have_posts()) { ?>
          <section class="related">
            <h3>Sleeper Alley</h3>
            <p>Thoughts and reactions to this story from the artist and readers.</p>
            <ul>
            <?php while($connected->have_posts()) : $connected->the_post(); ?>
              <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
            </ul>
          </section>
        <?php
        wp_reset_postdata();
        } ?>
      <section class="plea">
        <p class="comments"><strong>Thoughts, comments or questions about this story?</strong> Send me a note <a href="/feedback">here</a>, or via email at <a href="mailto:ed@sleeperave.com?subject=Comment on <?php the_title(); ?>" target="_blank">ed@sleeperave.com</a>. I publish my favorite comments weekly on my blog.</p>
        <div class="share-sub">
          <div class="share">
            <a class="facebook" onclick="fb_share('<?php the_permalink(); ?>')"><i class="fa fa-facebook"></i> Share</a>
            <a class="twitter" onclick="twitter_share('<?php the_permalink(); ?>', '<?php echo get_the_excerpt(); ?>')"><i class="fa fa-twitter"></i> Tweet</a>
            <a class="email" target="_blank" href="mailto:?subject=Sleeper Ave.: <?php the_title(); ?>&body=Hi!%0D%0A%0D%0AI thought you might enjoy this Sleeper Ave. comic by Ed Stein.%0D%0A%0D%0A<?php htmlentities(the_title()); ?>%0D%0A<?php echo htmlentities(get_the_excerpt()); ?>%0D%0A%0D%0A<?php htmlentities(the_permalink()); ?>"><i class="fa fa-envelope"></i> Send to a Friend</a>
            <a class="book" href="http://beaconreader.com/projects/sleeper-ave"><i class="fa fa-book"></i> Get the Book</a>
          </div>
          <div class="subscribe">
            <h3>Subscribe to the Sleeper Ave. mailing list</h3>
            <?php email_subscribe_form(); ?>
          </div>
          <div class="social">
            <div class="fb-like" data-href="https://facebook.com/sleeperave" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
            <a href="https://twitter.com/sleeperave" class="twitter-follow-button" data-show-count="false" data-size="small">Follow @sleeperave</a>
          </div>
        </div>
        <p class="appeal"><strong>I need your help!</strong> After a 37-year career in print, it's not easy building an audience from scratch. So if you enjoy Sleeper Ave., please help me out by subscribing, donating if you can, but most importantly, spreading the word. Share this story on Facebook, Twitter and elsewhere, email it to your friends, let people know! Every little bit helps, and I'll be forever grateful. Thanks! -- Ed</p>
      </section>
        <!--<?php user_card(get_the_author_meta('ID')); ?>-->
    </footer>
    <div class="share-fixed">
      <ul>
        <li>
          <a class="facebook" onclick="fb_share('<?php the_permalink(); ?>')">
            <i class="fa fa-facebook"></i>
            <span class="hide-small"> Share</span>
          </a>
        </li>
        <li>
          <a class="twitter" onclick="twitter_share('<?php the_permalink(); ?>', '<?php echo get_the_excerpt(); ?>')">
            <i class="fa fa-twitter"></i>
            <span class="hide-small"> Tweet</span>
          </a>
        </li>
        <li>
          <a class="email" target="_blank" href="mailto:?subject=Sleeper Ave.: <?php the_title(); ?>&body=Hi!%0D%0A%0D%0AI thought you might enjoy this Sleeper Ave. comic by Ed Stein.%0D%0A%0D%0A<?php htmlentities(the_title()); ?>%0D%0A<?php echo htmlentities(get_the_excerpt()); ?>%0D%0A%0D%0A<?php htmlentities(the_permalink()); ?>">
            <i class="fa fa-envelope"></i>
            <span class="hide-small"> Send</span>
          </a>
        </li>
        <li>
          <a class="book" href="http://beaconreader.com/projects/sleeper-ave">
            <i class="fa fa-book"></i>
            <span class="hide-small"> Get the Book</span>
          </a>
        </li>
      </ul>
    </div>
</article>

<section class="recommender bottom">
  <?php

  $prev_post = get_previous_post(true);
  if($prev_post !== '') {
    article_card($prev_post->ID, 'prev');
  }

  $next_post = get_next_post(true);
  if($next_post !== '') {
    article_card($next_post->ID, 'next');
  }

  //get our actions
  action_unit();

  ?>
</section>
<?php } /* close while */ } else { ?>

<article class="404">
    <h1>Not Found</h1>
    <p>Sorry, but you are looking for something that isn't here.</p>
</article>

<?php } /* close if */ ?>
<?php get_footer(); ?>
