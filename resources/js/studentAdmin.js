let studentAdmin = (function () {

    function hello() {
        console.log('The student administration JavaScript works! 🙂');
    }

    return {
        hello: hello    // publicly available as: VinylShop.hello()
    };
})();

export default studentAdmin;
