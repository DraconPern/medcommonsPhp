<? 
$time = strftime("%Y-%m-%d %H:%M:%S Z");
echo '<?xml version="1.0" encoding="UTF-8"?>';
function xmlentities($string) {
    return str_replace ( array ( '&', '"', "'", '<', '>' ), array ( '&amp;' , '&quot;', '&apos;' , '&lt;' , '&gt;' ), $string );
}
function uniqueId() {
  global $patient;
  return sha1( time() . $patient->patientMedCommonsId . rand() );
}
?>
<ContinuityOfCareRecord xmlns="urn:astm-org:CCR">
<CCRDocumentObjectID><?=uniqueId()?></CCRDocumentObjectID>
  <Language>
    <Text>English</Text>
  </Language>
  <Version>V1.0</Version>
  <DateTime>
  <ExactDateTime><?=$time?></ExactDateTime>
  </DateTime>
  <Patient>
    <ActorID>PATIENT</ActorID>
  </Patient>
  <From>
    <ActorLink>
      <ActorID>MEDCOMMONS</ActorID>
    </ActorLink>
  </From>
  <Purpose>
    <Description>
      <Text>Plan of Care Order</Text>
    </Description>
  </Purpose>
  <Body>
    <?if(isset($history)):?>
    <PlanOfCare>
      <Plan>
        <CCRDataObjectID><?=uniqueId()?></CCRDataObjectID>
        <Type>
          <Text>Order</Text>
        </Type>
        <Status>
          <Text>Pending</Text>
        </Status>
        <Source>
          <Actor>
            <ActorID>PATIENT</ActorID>
          </Actor>
        </Source>
        <OrderRequest>
          <CCRDataObjectID><?=uniqueId()?></CCRDataObjectID>
          <Description>
          <Text><?=xmlentities($history)?></Text>
          </Description>
          <Source>
            <Actor>
              <ActorID>PATIENT</ActorID>
            </Actor>
          </Source>
          <Procedures>
            <Procedure>
              <CCRDataObjectID><?=uniqueId()?></CCRDataObjectID>
              <DateTime>
                <ExactDateTime><?=$time?></ExactDateTime>
              </DateTime>
              <IDs>
                <ID><?=xmlentities($accessionNumber)?></ID>
                <Source>
                  <Actor>
                    <ActorID>PATIENT</ActorID>
                  </Actor>
                </Source>
              </IDs>
              <Type>
                <Text><?=xmlentities($procedureType)?></Text>
              </Type>
              <Description>
                <Text><?=xmlentities($procedure)?></Text>
              </Description>
              <Source>
                <Actor>
                  <ActorID>PATIENT</ActorID>
                </Actor>
              </Source>
            </Procedure>
          </Procedures>
        </OrderRequest>
      </Plan>
    </PlanOfCare>
    <?endif;?>
  </Body>
  <Actors>
    <Actor>
      <ActorObjectID>PATIENT</ActorObjectID>
      <Person>
        <Name>
          <CurrentName>
            <Given></Given>
            <Family></Family>
          </CurrentName>
        </Name>
        <Gender>
          <Text>Unknown</Text>
        </Gender>
      </Person>
      <IDs>
        <Type>
          <Text>MedCommons Account Id</Text>
        </Type>
        <ID><?=$patient->patientMedCommonsId?></ID>
        <IssuedBy>
          <ActorID>MEDCOMMONS</ActorID>
        </IssuedBy>
        <Source>
          <Actor>
            <ActorID>MEDCOMMONS</ActorID>
          </Actor>
        </Source>
      </IDs>
      <Status>
        <Text>Incomplete</Text>
        <Code>
            <Value>INCOMPLETE</Value>
		    <CodingSystem>MedCommons Patient Status</CodingSystem>
		    <Version>1.0</Version>            
        </Code>
      </Status>
      <Source>
        <Actor>
          <ActorID>MEDCOMMONS</ActorID>
        </Actor>
      </Source>
    </Actor>
    <Actor>
      <ActorObjectID>MEDCOMMONS</ActorObjectID>
      <InformationSystem>
        <Name>MedCommons Notification</Name>
        <Type>Repository</Type>
        <Version>V1.0</Version>
      </InformationSystem>
      <Source>
        <Actor>
          <ActorID>MEDCOMMONS</ActorID>
        </Actor>
      </Source>
    </Actor>
  </Actors>
</ContinuityOfCareRecord>
