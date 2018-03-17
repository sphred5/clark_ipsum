function showData() {
  var paranumber = document.getElementById('paraNumber');
  // console.log(paraNumber.value)
  $.ajax({
      url: "../Clark%20Ipsum/functions.php?paraNumber=" + paraNumber.value,
      datatype: "JSON"
    })
    .done(function (data) {
      displayData(data);
      console.log("success");
    })
    .fail(function () {
      console.log("error");
    })
    .always(function () {
      console.log("complete");
    });

}

function displayData(data) {
  let jsonObject = JSON.parse(data).result;
  let paraBox = document.getElementById('paraBox');
  let output = '';
  console.log(paraBox);
  console.log(jsonObject);
  for (let index = 0; index < jsonObject.length; index++) {
    const element = jsonObject[index];
    console.log(element);
    output = output + "<p>" + element + "</p>";
  }
  paraBox.innerHTML = output;
}