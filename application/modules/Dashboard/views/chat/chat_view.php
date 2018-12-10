<div id="chatModal" class="row" > 
<div v-bind:class="{hidden:showChat}" class= "sticky-chat"  tabindex="-1" role="dialog">
    <div class ="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chat with PrEP Team</h5>
            </div>
            <div class = "modal-body">
            <!--Place Iframe with chat application here.-->
            <iframe width= "100%" :src="chatUrl" :srcdoc="chatSrcdoc" frameborder="0"></iframe>
            </div>
            <div class ="modal-footer">
                <button v-on:click="showChat=!showChat" id="close-chat" type="button" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>
<button v-on:click="showChat=!showChat" type="button" class="btn btn-primary sticky-chat-button" >Chat with Us&nbsp;<span class="glyphicon glyphicon-user"></span></button>
</div>