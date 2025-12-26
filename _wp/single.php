<!doctype html>
<html>

<head>
	<?php get_template_part("parts/head"); ?>
</head>
<?php $url = $_SERVER['REQUEST_URI']; ?>
<body>
	<header class="underpage">
		<?php get_template_part("parts/header"); ?>
	</header>
	<?php get_template_part("parts/post"); ?>
	<?php if(strstr($url,'/member/')) : ?>
	<?php get_template_part("parts/booking"); ?>
	<?php endif; ?>
	<?php get_template_part("parts/hummenu"); ?>
	<?php get_template_part("parts/footer"); ?>
</body>
<?php get_template_part("parts/script"); ?>
<script>
function copyUrl() {
    const element = document.createElement('input');
    element.value = location.href;
    document.body.appendChild(element);
    element.select();
    document.execCommand('copy');
    document.body.removeChild(element);
		alert('URLをコピーしました。')
}
</script>
</html>
