<div id="chatModal" class="row" > 
<div v-bind:class="{hidden:showChat}" class= "sticky-chat"  tabindex="-1" role="dialog">
    <div class ="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Contact Us</h4>
            </div>
            <form id="supportForm" v-on:submit.prevent="sendMessage(<?= $session_data['id']; ?>)">
                <div class = "modal-body">
                        <div class ="form-group">
                            <label for="subject">Subject</label>
                            <input v-model="subject" type="text" class="form-control" id="subject" aria-describedby="subjectHelp" placeholder="Subject" >
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea v-model="message" class="form-control" id="message" placeholder="Message"></textarea>
                        </div>
                </div>
                <div class ="modal-footer">
                    <input v-on:click="showChat=!showChat" id="submit-query" type="submit" value="Ask" class="btn btn-primary">
                    <button v-on:click="showChat=!showChat" id="close-chat" type="button" class="btn btn-secondary">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<button v-on:click="showChat=!showChat" type="button" class="btn btn-primary sticky-chat-button" >Chat with Us&nbsp;<span class="glyphicon glyphicon-user"></span></button>
</div>