var selectedElements = {
    selectedParentElement: null,
    shownLinkButton: null,
};

function handlePageClick(event) {
    var targetNode = event.target;
    var hasCardParent =  targetNode.closest('div.card');

    if(selectedElements.shownLinkButton && selectedElements.selectedParentElement !== hasCardParent ) {
        selectedElements.shownLinkButton.classList.add('hidden');
    }

    if(!hasCardParent || !event.altKey) {
        return;
    }

    var parentCardId = hasCardParent.id;
    var articleButton = document.querySelector(`#${parentCardId} > .footer > .button-container > a`);
    articleButton.classList.remove("hidden");
    selectedElements.selectedParentElement = hasCardParent;
    selectedElements.shownLinkButton = articleButton;
}

function setupClickListener() {
    document.getElementById('container').addEventListener("click", handlePageClick); 
}