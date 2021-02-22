//  Initialize Quill editor

let toolbarOptions = [
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['blockquote', 'code-block'],
  ['link'],
  ['image'],
  ['video'],

  [{ 'header': 1 }, { 'header': 2 }],               // custom button values
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction

  [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
  [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  [{ 'font': ['Tahoma', 'EQPro-Regular', 'Quicksand'] }],
  [{ 'align': [] }],

  ['clean']                                         // remove formatting button
];

let elementBlog = document.getElementById("content");

if(typeof(elementBlog) != 'undefined' && elementBlog != null){
  let quillBlog = new Quill('#content', {
    // debug: 'info',
    modules: {
      toolbar : toolbarOptions
    },
    placeholder: 'Vous pouvez rédiger votre article de blog ici',
    //readOnly: true,
    theme: 'snow'
  });

  $('#saveDelta').on("mousedown", function () {
    let textareaBlog = document.getElementById('inputContent');
    textareaBlog.value = quillBlog.root.innerHTML;
    console.log(quillBlog.root.innerHTML);
    console.log(textareaBlog.value);
  });
}

let elementAstuce = document.getElementById("the_tip");

if(typeof(elementAstuce) != 'undefined' && elementAstuce != null){
  let quillAstuce = new Quill('#the_tip', {
    // debug: 'info',
    modules: {
      toolbar : toolbarOptions
    },
    placeholder: 'Vous pouvez rédiger votre astuce ici',
    //readOnly: true,
    theme: 'snow'
  });

  $('#saveDelta').on("mousedown", function () {
    let textareaAstuce = document.getElementById('inputAstuce');
    textareaAstuce.value = quillAstuce.root.innerHTML;
    console.log(quillAstuce.root.innerHTML);
    console.log(textareaAstuce.value);
  });
}

let elementSource = document.getElementById("sourcesContent");

if(typeof(elementSource) != 'undefined' && elementSource != null){
  let quillSource = new Quill('#sourcesContent', {
    // debug: 'info',
    modules: {
      toolbar : toolbarOptions
    },
    placeholder: 'Vous pouvez rédiger votre source ici',
    //readOnly: true,
    theme: 'snow'
  });

  $('#saveDelta').on("mousedown", function () {
    let textareaSource = document.getElementById('inputSource');
    textareaSource.value = quillSource.root.innerHTML;
    console.log(quillSource.root.innerHTML);
    console.log(textareaSource.value);
  });
}
