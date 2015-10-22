jQuery(function($) {
        $lis = $('.portfolio-bg nav.posts-list > ul > li'); 
        min = 6;
        max = $lis.length;
        var visible = min;
        
        function showUpToIndex(index) {
            $lis.hide();
            $lis.slice(0, index).show();
        }
    
        function disableButtons(){
            if (visible >= max){
                visible = max;
                $('#more').hide();
            }
            else
            {
                $('#more').show();
            }
            if (visible <= min){
                visible = min;
                $('#less').hide();
            }
            else
            {
                $('#less').show();
            }
        }
        
        showUpToIndex(visible);
        disableButtons();
        
        $('#more').click(function(e) {
            e.preventDefault();
            visible = visible + 3;
            disableButtons();  
            showUpToIndex(visible);
        });
        
        $('#less').click(function(e) {
            e.preventDefault();
            visible = visible - 3;
            disableButtons();     
            showUpToIndex(visible);
        });
    });