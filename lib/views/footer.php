<?php
$scripts = $this->scripts
?>

</main>
<?php foreach ($scripts as $script) {
    echo "<script type='module' src='/".BASE_URL."/public/js/$script.js'></script>";
} ?>
</body>
</html>