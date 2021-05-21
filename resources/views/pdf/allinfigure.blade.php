<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Final Cost- All Figures</title>

    <style>
        /** 
            * Define the width, height, margins and position of the watermark.
            **/
            #watermark {
                position: fixed;

                /** 
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   5.5cm;
                left:     0.5cm;

                /** Change image dimensions**/
                width:    18cm;
                height:   18cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }
            #signature {
                position: fixed;

                /** 
                    Set a position in the page for your image
                    This should center it vertically
                **/
                bottom:   5.5cm;
                left:     0.5cm;

                /** Change image dimensions**/
                width:    18cm;
                height:   18cm;

                /** Your watermark should be behind every content**/
                z-index:  -1000;
            }    
    </style>
</head>
<body>
<img src="img/selby.png" width='700px;' height="50px" style="margin-bottom:10px;">
    @php echo $head;@endphp
    @php echo $tables;@endphp
    @php echo $pages;@endphp
    @php echo $additionals;@endphp
    <div id="watermark">
            <img src="img/watermark1.png" height="100%" width="100%"/>
    </div>
    @php echo $outwork;@endphp
    @php echo $outwork_totals;@endphp
    @php echo $consumables;@endphp

</body>
</html>