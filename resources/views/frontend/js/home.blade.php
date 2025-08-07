<script>
    let root = document.documentElement;
    function findBootstrapEnvironment() {
        let envs = ['xs', 'sm', 'md', 'lg', 'xl'];

        let el = document.createElement('div');
        document.body.appendChild(el);

        let curEnv = envs.shift();

        for (let env of envs.reverse()) {
            el.classList.add(`d-${env}-none`);

            if (window.getComputedStyle(el).display === 'none') {
                curEnv = env;
                break;
            }
        }

        document.body.removeChild(el);
        return curEnv;
    }
    if(findBootstrapEnvironment()=="md"){ root.style.setProperty('--game-columns',2); }
</script>
<script type="text/javascript">
    $(function () {
        var result = bowser.getParser(window.navigator.userAgent);
        if(result.parsedResult.os.name=="iOS")
        {
            $('.btn').attr('target','_blank');
        }
        get_winners()
    });
    function get_winners() {
        var str = '   <tr>\n' +
            '                                <td>{{$data->winner_theading1!=null?$data->winner_theading1:'Winner'}}</td>\n' +
            '                                <td>{{$data->winner_theading2!=null?$data->winner_theading2:'Time'}}</td>\n' +
            '                                <td>{{$data->winner_theading3!=null?$data->winner_theading3:'Tokens'}}</td>\n' +
            '                            </tr>';
        $.ajax({
            url   : '/games_winner',
            type  : 'get',
            dataType : 'json',
            success : function (result) {
                if(!jQuery.isEmptyObject(result))
                {
                    $.each(result,function (i,item) {
                        var aDate = new Date(
                            Date.parse(item.created_at)
                        );
                        var hours = aDate.getHours()<10?'0'+aDate.getHours():aDate.getHours();
                        var mins  = aDate.getMinutes()<10?'0'+aDate.getMinutes():aDate.getMinutes();
                        var ampm = hours >= 12 ? 'pm' : 'am';
                        hours = hours % 12;
                        hours = hours ? hours : 12;
                        var html = '<tr><td>'+item.user_name+'</td><td>'+hours+':'+mins+' '+ampm+'</td><td>'+item.amount+' play6 </td></tr>';
                        str+= html;
                    });
                    $('#termsrow').html(str);
                }
            },
            error   : function (result) {
                console.log('in error');
            }
        })
        setInterval(get_winners, 900000);
    }
</script>
