<form class="chat-form">
        <div class="chat-container">
            <div class="form-input">
                <textarea name="text_message" id="text_message" class="textarea-control" placeholder="Type your message..."></textarea>
            </div>
            <div class="form-input">
                <label for="upload-files" id="upload-label"><i class="fas fa-paperclip fa-uploads"></i>
                <i class="fas fa-file-image fa-uploads"></i></label>
                <input type="file" name="send_file" id="upload-files" class="files-upload">
            </div>
        </div>
        <div class="files-error">
            <span class="files-cross-icon">&#x2715;</span>
            Please choose valid image
        </div>
</form>