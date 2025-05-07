const cursor = document.querySelector('.custom-cursor');

document.addEventListener('mousemove', (e) => {
  cursor.style.top = `${e.clientY}px`;
  cursor.style.left = `${e.clientX}px`;
});

function load_channel () {
    $('#channel-list').load('./php/loadChannel.php', function () {
        initSidebarInteractions();
    });
    
}

function load_messages(channel_id) {
    $('#message-container').load("./php/loadMessage.php?channel_id="+channel_id)
}

let channel_id;

function initSidebarInteractions() {
    let items = document.querySelectorAll('.item');
    let action = document.getElementById('action');
    let icondowns = document.querySelectorAll('.fa-chevron-down');

    items.forEach(item => {
        console.log(item); // devrait maintenant bien loguer les bons éléments

        item.addEventListener('click', function(e){
            channel_id = item.getAttribute("data-channel-id");
            if( this.classList.contains('active') || e.target.classList.contains('fa-chevron-down')){
                return;
            }
            items.forEach(remove_active => {
                remove_active.classList.remove('active');
            });

            this.classList.add('active');
            document.documentElement.style.setProperty('--height-begin', action.offsetHeight + 'px');
            document.documentElement.style.setProperty('--top-begin', action.offsetTop + 'px');
            document.documentElement.style.setProperty('--height-end', this.offsetHeight + 'px');
            document.documentElement.style.setProperty('--top-end', this.offsetTop + 'px');
            action.classList.remove('runanimation');
            void action.offsetWidth;
            action.classList.add('runanimation');
        }, false);
    });

    icondowns.forEach(icon =>{
        icon.addEventListener('click', function(){
            this.classList.toggle('showMenuChild');
            items.forEach(item => {
                if(item.classList.contains('active')){
                    document.documentElement.style.setProperty('--height-end', item.offsetHeight + 'px');
                    document.documentElement.style.setProperty('--top-end', item.offsetTop + 'px');
                    return;
                }
            });
        });
    });
}

// Appel initial
load_channel();


let items = document.querySelectorAll(".item")
let channelId;

const sender_id = document.body.dataset.userId;

$(document).ready(function (){

    $('#channel-list').on('click', '.item', function() {

        channelId = this.getAttribute("data-channel-id")
        console.log(channelId);
        
        // $.post('./php/loadMessage.php', { channel_id: channelId }, function(data) {
        //     $('#message-container').html(data);
        // });
        
        load_messages(channelId)

  })


  const submitButton = document.getElementById("submitButton");
  const toolbarOptions = [
      ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
      ['blockquote', 'code-block'],
    
      [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
    
      ['clean']                                         // remove formatting button
    ];
  
    const quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: "Tapez un message...",
      modules: {
        keyboard: {
          bindings: {
            shift_enter: {
              key: 13,
              shiftKey: true,
              handler: (range, ctx) => {
                console.log(range, ctx); // if you want to see the output of the binding
                quill.insertText(range.index, '\n');
              }
            },
            enter: {
              key: 13,
  
              handler: () => { console.log("enter");
               }
            }
          }
        }
      }
    });

})

function sendMessage(channel_id, message, sender_id) {
    console.log(channelId);
    
    $.ajax({
        method: 'POST',
        url: "./php/sendMessage.php",
        data: {channel_id: channel_id, message: message, sender_id: sender_id},
        success: (res) => {
            console.log(res);  
        }
    })
}




  document.getElementById('message-form').addEventListener('submit', function(e) {
    e.preventDefault();
    // Récupère le contenu HTML de Quill
    console.log("submit");
    
    let messageHtml = quill.root.innerHTML;
    
    // Le copie dans le textarea caché
    document.getElementById('text-message').value = messageHtml;

    sendMessage(channelId, messageHtml, sender_id)
  });