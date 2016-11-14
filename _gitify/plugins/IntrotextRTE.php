id: 11
name: IntrotextRTE
properties: 'a:0:{}'
disabled: 1

-----

$modx->regClientStartupHTMLBlock('<script>
    MODx.on("ready", function(){
        // add RTE for introtext field
        if(MODx.loadRTE) MODx.loadRTE("modx-resource-introtext");
    });
</script>');