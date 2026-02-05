document.addEventListener("mouseover", function(e) {
	// Selector to preview block where you want to show background image
	const previewContainer = document.querySelector('.block-editor-inserter__preview-content-missing');

	if (!previewContainer) {
		return;
	}

	if (e.target.closest('.block-editor-block-types-list__item')) {
		const hoveredBlock = e.target.closest('.block-editor-block-types-list__item');

		// to find a name of the block we can extract it from block classes

		// Retrieve classes from the block on which the mouse is hovered
		const blockClasses = hoveredBlock.className.split(' ');

		// Finding a class that starts with "editor-block-list-item-acf-"
		const blockClass = blockClasses.find(cls => cls.startsWith("editor-block-list-item-acf-"));

		// If such a class is found, extract the name from it
		if (blockClass) {
			const blockName = blockClass.replace("editor-block-list-item-acf-", "");

			// Get the image URL for this block
			const imageUrl = wp.data.select('core/blocks').getBlockType("acf/" + blockName)?.attributes?.previewImage?.default;

            document.querySelector('.block-editor-inserter__preview-content-missing')?.innerHTML;

			// adding our styles if there is a link to the picture
			if (imageUrl) {
                previewContainer.style.position = 'relative';
                let img = previewContainer.querySelector('.mm-preview-img');

                if (!img) {
                    img = document.createElement('img');
                    img.className = 'mm-preview-img';
                    img.style.position = 'absolute';
                    img.style.top = '0';
                    img.style.left = '0';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    img.style.zIndex = '10';
                    previewContainer.appendChild(img);
                }

                img.src = imageUrl;

            } else {
                const img = previewContainer.querySelector('.mm-preview-img');
                if (img) img.remove();
            }

		}
	}
});