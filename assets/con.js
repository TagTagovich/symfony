 

 /*$(document).ready(function(){
 alert(jQuery.fn.jquery);
 });*/

        /*document
            .querySelectorAll('.add_item_link')
            .forEach(btn => btn.addEventListener("click", addFormToCollection));
        const addFormToCollection = (e) => {
            const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

        const item = document.createElement('li');

        item.innerHTML = collectionHolder
            .dataset
            .prototype
            .replace(
            /__name__/g,
      collectionHolder.dataset.index
    );

  collectionHolder.appendChild(item);

  collectionHolder.dataset.index++;
};*/

const addImageLink = document.createElement('a')
addImageLink.classList.add('add_image_list')
addImageLink.href='#'
addImageLink.innerText='Add a image'
addImageLink.dataset.collectionHolderClass='images'

const newLinkLi = document.createElement('li').append(addImageLink)

const collectionHolder = document.querySelector('ul.images')
collectionHolder.appendChild(addImageLink)

const addFormToCollection = (e) => {
	const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

      const item = document.createElement('li');

      item.innerHTML = collectionHolder
        .dataset
        .prototype
        .replace(
          /__name__/g,
          collectionHolder.dataset.index
        );

      collectionHolder.appendChild(item);

      collectionHolder.dataset.index++;
}

addImageLink.addEventListener("click", addFormToCollection)