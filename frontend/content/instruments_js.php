
<script>
$( function(){

var instruments = ["Accordion","Bagpipes","Banjo","Bass guitar","Bassoon","Berimbau","Bongo","Cello","Clarinet","Clavichord","Cor anglais","Cornet","Cymbal","Didgeridoo","Double bass","Drum kit","Euphonium","Flute","French horn","Glass harmonica","Glockenspiel","Gong","Guitar","Hang","Harmonica","Harp","Harpsichord","Hammered dulcimer","Hurdy gurdy","Kalimba","Lute","Lyre","Mandolin","Marimba","Melodica","Oboe","Ocarina","Octobass","Organ","Oud","Pan Pipes","Pennywhistle","Piano","Piccolo","Pungi","Recorder","Saxophone","Sitar","Synthesizer","Tambourine","Timpani","Triangle","Trombone","Trumpet","Theremin","Tuba","Ukulele","Viola","Violin","Vocal cords","Whamola","Xylophone","Zither"]

    $("#myInput").autocomplete({
        source: instruments,
        appendTo: "#searchF"
    });
});
</script>