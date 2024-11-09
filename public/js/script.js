document.getElementById("ongkirForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Are you sure you want to submit this form?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, submit it!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("ongkirForm").submit();
        }
    });
});