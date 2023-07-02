$(document).ready(() => {
    class AnimationOpenJQ{
        constructor(btn, block){
            this.block = block;
            this.mode = false;
            this.btn = btn;
            this.btn.on('click', () => {
                this.triger();
            })
        }

        triger(){
            if (this.mode){
                this.block.hide(500);
                this.mode = !this.mode;
            } else {
                this.block.show(500);
                this.mode = !this.mode;
            }
        }

    }

    new AnimationOpenJQ($('#cart-icon-card'),$('.cart__container'));
    new AnimationOpenJQ($('#cart-icon-favorietes'),$('.favorietes__container'));

    addToCart(document.querySelectorAll('.product-links > div'),'.product-links > div');

    $('.cart__reset__btn').on('click', function(){
        let data = {'action': 'delete_all'};
        newAjaxQuery('index.php', data, 'POST')
            .then(function(responce){
                responce = $.parseJSON(responce);
                refreshContainerCart($('.cart__products__container'),responce);
                refreshContainerFavor($('.favorietes__products__container'), responce);
                refreshBtnIconFromDelete($('.product-links > div'));
                addToCart(document.querySelectorAll('.product-links > div'),'.product-links > div');
            })
    });
});