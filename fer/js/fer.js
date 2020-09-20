let scoreThreshold = 0.5
let sizeType = '160'
let modelLoaded = false
var cImg;
var constraints = {
    audio: false,
    video: {
        width: 400,
        height: 400
    }
};
var EmotionModel;
var offset_x = 27;
var offset_y = 20;
var emotion_labels = ["angry", "disgust", "fear", "happy", "sad", "surprise", "neutral"];
var emotion_colors = ["#ff0000", "#00a800", "#ff4fc1", "#ffe100", "#306eff", "#ff9d00", "#7c7c7c"];
var arrayCountEmotion = [0, 0, 0, 0, 0, 0, 0];
let forwardTimes = []

function updateTimeStats(timeInMs) {
    forwardTimes = [timeInMs].concat(forwardTimes).slice(0, 30)
    const avgTimeInMs = forwardTimes.reduce((total, t) => total + t) / forwardTimes.length
    $('#time').val(`${Math.round(avgTimeInMs)} ms`)
    $('#fps').val(`${faceapi.round(1000 / avgTimeInMs)}`)
}

function onIncreaseThreshold() {
    scoreThreshold = Math.min(faceapi.round(scoreThreshold + 0.1), 1.0)
    $('#scoreThreshold').val(scoreThreshold)
}

function onDecreaseThreshold() {
    scoreThreshold = Math.max(faceapi.round(scoreThreshold - 0.1), 0.1)
    $('#scoreThreshold').val(scoreThreshold)
}



async function onPlay(videoEl) {
    if (videoEl.paused || videoEl.ended || !modelLoaded)
        return false

    const {
        width,
        height
    } = faceapi.getMediaDimensions(videoEl)
    const canvas = document.createElement('canvas');
    canvas.width = width
    canvas.height = height

    const forwardParams = {
        inputSize: parseInt(sizeType),
        scoreThreshold
    }

    const ts = Date.now()
    const result = await faceapi.detectAllFaces(videoEl, new faceapi.TinyFaceDetectorOptions(forwardParams))
    console.result
//            const result = await faceapi.tinyYolov2(videoEl, forwardParams)
    if (result.length != 0) {


        const context = canvas.getContext('2d')
        context.drawImage(videoEl, 0, 0, width, height)

        let ctx = context;
        ctx.lineWidth = 4;
        ctx.font = "25px Arial"
        ctx.fillText('Result', 0, 0);

        for (var i = 0; i < result.length; i++) {
            ctx.beginPath();
            var item = result[i].box;
            let s_x = Math.floor(item._x+offset_x);
            if (item.y<offset_y){
                var s_y = Math.floor(item._y);
            }
            else{
                var s_y = Math.floor(item._y-offset_y);
            }
            let s_w = Math.floor(item._width-offset_x);
            let s_h = Math.floor(item._height);
            let cT = ctx.getImageData(s_x, s_y, s_w, s_h);
            cT = preprocess(cT);

            z = EmotionModel.predict(cT)
            let index = z.argMax(1).dataSync()[0]
            let label = emotion_labels[index];
            arrayCountEmotion[index]++;
            console.log(arrayCountEmotion);
            $("#facialemotion").html("Emotion du visage = "+label);
            var pond = 0;
            switch(label) {
                case "angry":
                  // code block
                  pond = 0;
                  break;
                case "disgust":
                  // code block
                  pond = 0;
                  break;
                case "fear":
                    // code block
                    pond = 0;
                  break;
                case "happy":
                  // code block
                  pond = 1;
                  break;
                case "sad":
                  // code block
                  pond= 0;
                  break;
                case "surprise":
                  // code block
                  pond = 1;
                  break;
                case "neutral":
                  // code block
                  pond = 1;
                  break;
                default:
                  // code block
              } 
            
            $("#etat").val(pond);
          
        }

    }


    updateTimeStats(Date.now() - ts)

    //            faceapi.drawDetection('overlay', result.map(det => det.forSize(width, height)), {
    //                withScore: false
    //            })
    setTimeout(() => onPlay(videoEl))
}
async function loadNetWeights(uri) {
    return new Float32Array(await (await fetch(uri)).arrayBuffer())
}
// create model
async function createModel(path) {
    let model = await tf.loadLayersModel(path)
    return model
}
// load emotion model
async function loadModel(path) {
    //            var lbl = document.getElementById("status");
    //            lbl.innerText = "Model Loading ..."
    //            let canvas = document.getElementById("combined");
    //            let cT = preprocess(cImg)
    EmotionModel = await createModel(path)
    //            z = model.predict(cT)
    //            toPixels(deprocess(z), canvas)
    //            lbl.innerText = "Model Loaded !"
}

function preprocess(imgData) {
    return tf.tidy(() => {
        let tensor = tf.browser.fromPixels(imgData).toFloat();

        tensor = tensor.resizeBilinear([100, 100])

        tensor = tf.cast(tensor, 'float32')
        const offset = tf.scalar(255.0);
        // Normalize the image 
        const normalized = tensor.div(offset);
        //We add a dimension to get a batch shape 
        const batched = normalized.expandDims(0)
        return batched
    })
}

function successCallback(stream) {
    var videoEl = $('#inputVideo').get(0)
    videoEl.srcObject = stream;
}

function errorCallback(error) {
    alert(error)
    console.log("navigator.getUserMedia error: ", error);
    //            alert("navigator.getUserMedia error: ", error)
}

async function run() {
    const Model_url = 'http://localhost/fer/models/tiny_face_detector/tiny_face_detector_model-weights_manifest.json'
    await faceapi.loadTinyFaceDetectorModel(Model_url)
    modelLoaded = true


    navigator.mediaDevices.getUserMedia(constraints)
        .then(successCallback)
        .catch(errorCallback);

    onPlay($('#inputVideo').get(0))
    $('#loader').hide()
}

$(document).ready(function() {
    loadModel('http://localhost/fer/models/mobilenetv1_models/model.json')
})
