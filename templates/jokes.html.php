<div class="jokelist">

  <ul class="categories">
    <?php foreach($categories as $category): ?>
      <li><a href="/joke/list?category=<?=$category->id?>"><?=$category->name?></a></li>
    <?php endforeach; ?>
  </ul>

<div class="jokes">
<p><?=$totalJokes?> jokes have been submitted to the Internet Joke Database.</p>

<?php foreach ($jokes as $joke): ?>
  <blockquote>
      <?=(new \Ninja\Markdown($joke->joketext))->toHtml()?>
  (by <a href="mailto:<?php
  echo htmlspecialchars($joke->getAuthor()->email, ENT_QUOTES,
  'UTF-8'); ?>"><?php
  echo htmlspecialchars($joke->getAuthor()->name, ENT_QUOTES,
  'UTF-8'); ?></a> on <?php
  $date = new DateTime($joke->jokedate);
  echo htmlspecialchars($date->format('jS F Y'), ENT_QUOTES,
  'UTF-8');?>)
  <?php if($user): //because the $user variable may be empty if no one is logged in.?>
    <?php if($user->id == $joke->authorid || $user->hasPermission(\Ijdb\Entity\Author::EDIT_JOKES)): ?>
    <a href="/joke/edit?id=<?=$joke->id?>">
    Edit</a>
    <?php endif; ?>
    <?php if($user->id == $joke->authorid || $user->hasPermission(\Ijdb\Entity\Author::DELETE_JOKES)): ?>
        <form action="/joke/delete" method="post">
          <input type="hidden" name="id" value="<?=$joke->id?>">
          <input type="submit" value="Delete">
        </form>
    <?php endif; ?>
  <?php endif; ?>
  </blockquote>

<?php endforeach; ?>


Select page:

<?php
$numPages = ceil($totalJokes/10);
for ($i = 1; $i <= $numPages; $i++):
  if ($i == $currentPage):
?>
  <a class="currentpage" href="/joke/list?page=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : '' ?>"><?=$i?></a>
<?php else: ?>
  <a href="/joke/list?page=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : '' ?>"><?=$i?></a>
<?php endif; ?>
<?php endfor; ?>

</div>
</div>
