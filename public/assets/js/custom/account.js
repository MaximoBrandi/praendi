async function followAccount(token, id) {
    response = await fetch('/follow-account', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        'account': id,
        '_token': token
    })
    });
    const data = await response.text();

    if (data) {
        console.log(data);
    }
}

function replycomment(id) {
    document.getElementById("reply_id").value = id
    document.getElementById("reply-text").innerHTML = 'Leave a reply to '+(document.getElementById("comment-"+id).innerHTML)
}

async function newsletter(token, email, debug = null) {
    if (email !== null) {
        response = await fetch('/newsletter-create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'email': email,
                '_token': token
            })
            });
            const data = await response.text();

            if (data) {
                if (debug) {
                    console.log(data);
                }else{
                    location.reload();
                }
            }
    }
}

async function deleteComment(id, token) {
    response = await fetch('/post', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        'comment': id,
        '_token': token
    })
    });
    const data = await response.text();

    if (data) {
        location.reload();
    }
}

async function like(id, token, debug = null) {
    response = await fetch('/post', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        'post': id,
        '_token': token
    })
    });
    const data = await response.text();

    if (data) {
        if (debug) {
            console.log(data);
        }else{
            location.reload();
        }
    }
}
