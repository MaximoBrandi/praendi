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

async function newsletter(token, email) {
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
        console.log(data);
    }
}
