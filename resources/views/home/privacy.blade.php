@extends('layouts.app')

@section('content')
  <div class="col mx-0 px-0">


    <div class="yy-privacy">
      <img class="mx-auto d-block" src="/images/app_images/yyuxlogo_black.png" alt="yyUXネコ">
      <h1 class="text-center">個人情報の取り扱いについて</h1>
      <h2>1.個人情報の定義について</h2>
      <p>個人情報とは、個人に関する情報であって、その情報を構成する氏名、住所、電話番号、メールアドレス、勤務先、生年月日その他の記述等により個人を識別できるものをいいます。また、その情報のみでは識別できない場合でも、他の情報と容易に照合することができ、結果的に個人を識別できる情報も個人情報に含まれます。</p>

      <h2>2.個人情報の取得と目的について</h2>
      <ol>
        <li>弊社レビュー投稿サイトの登録</li>
        <ul>
          <li>当社によるレビュー投稿サイトへの登録</li>
          <li>当社が提供するレビュー投稿サイトのご案内や資料の送付</li>
          <li>マーケティングのご協力依頼やマーケティング結果の報告、キャンペーンの告知。モニター等への応募、プレゼントの発送等</li>
          <li>個人情報を特定できない形式の統計資料としての利用</li>
          <li>その他、上記業務に関連又は付随する業務</li>
        </ul>
        <li>お問い合わせ</li>
        <ul>
          <li>各お問い合わせに対するご連絡</li>
          <li>個人情報を特定できない形式の統計資料としての利用</li>
        </ul>
      </ol>

      <h2>3.個人情報を提供しなかった場合に生じる結果について</h2>
      <p>必要となる項目を入力いただかない場合は、本サービスを受けられないことがあります。</p>

      <h2>個人情報の第三者提供について</h2>
      <ol>
        <li>取得した個人情報について、ご本人の同意を得ずに第三者に提供することは、原則いたしません。提供先および提供する内容を特定した上で、ご本人の同意を得た場合に限り、提供いたします。</li>
        <li>以下の場合は、ご本人の同意なく個人情報を提供することがあります。
          <ul>
            <li>法令に基づく場合</li>
            <li>人の生命、身体又は財産の保護のために必要がある場合であって、ご本人の同意を得ることが困難である場合</li>
            <li>公衆衛生の向上又は児童の健全な育成の推進のために特に必要がある場合であって、ご本人の同意を得ることが困難である場合</li>
            <li>国の機関若しくは地方公共団体又はその委託を受けた者が法令の定める事務を遂行することに協力する必要がある場合であって、ご本人の同意を得ることにより、その事務の遂行に支障を及ぼすおそれがあると当社が判断した場合</li>
            <li>裁判所、検察庁、警察、弁護士会、消費者センター又はこれらに準じた権限を有する機関から、個人情報についての開示を求められた場合</li>
            <li>ご本人から明示的に第三者への提供を求められた場合</li>
            <li>合併その他の事由による事業の承継に伴って個人情報が提供される場合</li>
          </ul>
        </li>
      </ol>

      <h2>5.個人情報の委託について</h2>
      <p>当社は利用目的の達成に必要な範囲内で、個人情報の取り扱いの全部又は一部を委託する場合があります。なお、個人情報の取り扱いを委託する場合は適切な委託先を選定し、個人情報が安全に管理されるよう適切に監督いたします。</p>
      <h2>6.開示対象個人情報の開示等の請求手続きについて</h2>
      <ol>
        <li>請求手続きについて</li>
        <p>当社で保有している開示対象個人情報に関して、ご本人又はその代理人からの利用目的の通知、開示、内容の訂正、追加又は削除、利用の停止、消去および第三者への提供の停止の請求（以下「開示等の請求」といいます。）につきましては、当社が定める所定の手続きに則り速やかに対応いたします。ただし、開示等の請求に対応することによって以下のいずれかに該当する場合は、対応できない旨とその理由をご本人又はその代理人に説明した上で、開示等の請求に対応できない場合がございます。</p>
        <ul>
          <li>ご本人又は第三者の生命、身体、財産その他の権利利益を害するおそれがある場合</li>
          <li>当社の業務の適正な実施に著しい支障を及ぼすおそれがある場合</li>
          <li>法令に違反することとなる場合</li>
        </ul>
        <p >個人情報を削除、利用停止等した場合、現在ご利用中のサービスなどを受けることができなくなる場合がございます。また当社サービスの提供の終了などで必要のなくなった個人情報につきましては、当社の規程に従い処分いたします。</p>

        <li>請求手続き時の証明書等について</li>
        <p>①ご本人様の場合</p>
        <p>開示等の請求の際、以下の本人確認書類のうちいずれか1点の写しをご同封ください。なお、住所が本籍地と「同上」とされている場合を除き、本籍地は黒塗り等により抹消してください。</p>
        <ul>
          <li>運転免許証</li>
          <li>健康保険証</li>
          <li>住民基本カード</li>
          <li>年金手帳</li>
          <li>外国人登録証</li>
          <li>パスポート</li>
        </ul>
        <p>②代理人様の場合</p>
        <p>開示等の請求をする方が代理人様である場合は、上記①の書類に加えて、以下の本人確認書類(写し)をご提出下さい。</p>
        <p>現住所が確認できるもので、本籍部分は黒塗りしておいて下さい。</p>
        <p>A. 法定代理人</p>
        <ul>
          <li>法定代理権があることを確認するための書類（戸籍謄本、親権者の場合は扶養家族が記入された保険証のコピー等）</li>
          <li>法定代理人ご本人であることを確認するための書類（法定代理人の運転免許証、または健康保険証のコピー等）</li>
        </ul>
        <p>B. 委任による代理人の場合</p>
        <ul>
          <li>委任状</li>
          <li>代理人ご本人であることを確認するための書類（代理人の運転免許証、または健康保険証のコピー等）</li>
        </ul>
        <p>本開示等の請求で提供された個人情報は開示等の請求手続きに必要な範囲で使用します。いただいた本人確認書類又は代理人確認書類は、確認作業後ただちに適切な方法で廃棄します。また、手続き完了後一定期間が経過した開示請求依頼書についても、適切な方法で廃棄します。</p>

        <li>開示等の請求申出先</li>
        <p>当社の下記窓口に、開示等の請求を行う旨ご連絡ください。その後、当社から送付する指定様式（開示請求依頼書）に必要事項をご記入の上、下記2項に示す本人確認書類と併せてご返送ください。なお、当該ご請求のうち、利用目的の通知、個人情報の開示につきましては、手数料等は一切いただきません。</p>
        <p>開示等の請求への対応につきましては、必要事項記入済みの開示請求依頼書および本人確認書類の受領後14営業日以内に、ご指定の住所に書面で郵送させていただきます。</p>
        <ol>
            <h3>お問い合わせ窓口</h3>
            <p>ハマダエンタープライズ株式会社</p>
            <p>メールアドレス:{{ Config::get('const.ADMIN_MAIL') }}</p>
            <p>※土曜日、日曜日、祝日、年末年始、その他当社休業日は、翌営業日以降の対応とさせていただきます。</p>
        </ol>
      </ol>

      <h2>7.本人が容易に認識できない方法による個人情報の取得について</h2>
      <p>本サイトにおいて、サービス向上やアクセス状況などの統計的情報を取得する目的で、クッキー等の技術を使用することがありますが、これらの技術の使用により、ご本人が入力していない個人情報を取得することはありません。</p>
      <ol>
          <p class="mb-0">a. クッキー</p>
          <ol>
            <li>クッキーとは？
                <p>クッキーとは、ウェブサイトを利用した際に、ブラウザとサーバーとの間で送受信した利用履歴や入力内容などを、コンピュータにファイルとして保存しておく仕組みです。次回、同じページにアクセスすると、ウェブサイトの運営者は、クッキーの情報を使って利用者ごとに表示を変えたりすることができます。ブラウザの設定でクッキーの送受信を許可している場合、ウェブサイトは、利用者のブラウザからクッキーを取得できます。なお、プライバシー保護のため、利用者のブラウザは、利用したウェブサイトのサーバーが送受信したクッキーのみを送信します。</p>
            </li>
            <li>クッキーの設定について
                <ul>
                  <li>クッキーの送受信に関する設定は、「すべてのクッキーを許可する」、「すべてのクッキーを拒否する」、「クッキー受信時に通知する」などから選択できます。設定方法はブラウザにより異なりますので、お使いのブラウザの「ヘルプ」メニューでご確認ください。</li>
                  <li>すべてのクッキーを拒否する設定を選択した場合、認証が必要なサービスを受けられなくなる等、インターネット上の各種サービスのご利用において、制約を受ける場合がありますのでご注意ください。</li>
                </ul>
            </li>
            <li>当社がクッキーを使用して行なっていること
                <p>以下の目的のため、当社はクッキーを利用しています。</p>
                <ul>
                  <li>利用者が認証サービスにログインした際に、保存されている利用者の登録情報を参照して、利用者ごとにカスタマイズされたサービスを提供できるようにするため</li>
                  <li>利用者が興味を持っている内容や、当社ウェブサイト上での利用状況をもとに、最適な広告を他社サイト上で表示するため</li>
                  <li>当社のサイトの利用者数やトラフィックを調査するため</li>
                  <li>当社のサービスを改善するため</li>
                  <li>セキュリティー保持のため、ご利用から一定の時間が経過した利用者に対してパスワードの再入力（再認証）を促すため</li>
                </ul>
                <p>なお、当社は、広告配信の委託に基づき、他社サイトを経由して、当社のクッキーを保存し、参照する場合があります。</p>
            </li>
          </ol>
          <p class="mb-0">b. 携帯端末の個体識別番号</p>
          <p>携帯端末の個体識別番号とは、携帯端末で本サイトにアクセスした際に、携帯端末を区別するために利用者の携帯端末が送信する番号のことで、アクセス管理などに利用しております。個体識別番号には、利用者の携帯電話番号やメールアドレス、氏名など、利用者のプライバシーに関する情報は含まれておりません。また個体識別番号のみでは、登録ユーザー個人を特定する事はできません。</p>
      </ol>
    </div>
  </div>
@endsection

@section('rightSideBar')
@endsection
